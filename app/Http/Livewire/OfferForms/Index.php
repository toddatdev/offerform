<?php

namespace App\Http\Livewire\OfferForms;

use App\Http\Livewire\Traits\CopyOFLink;
use App\Models\OfferForms\OfferForm;
use App\Models\OfferForms\OfferFormSection;
use App\Models\OfferForms\OfferFormSectionLogic;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cookie;
use Livewire\Component;

class Index extends Component
{
    use CopyOFLink;
    public $backTo;

    /**
     * @var string
     */
    public $search = '';

    /**
     * @var string
     */
    public $displayAs = 'grid';

    /**
     * @var string
     */
    public $sortBy = 'user';

    /**
     * @var int
     */
    public $limitPerPage = 10;

    /**
     * @var string[]
     */
    protected $listeners = [
        'offerforms-refresh' => '$refresh',
        'load-more' => 'loadMore',
    ];

    /**
     * @return void
     */
    public function mount()
    {
        $this->displayAs = Cookie::get('offer_forms_display_as', 'grid');
        $this->sortBy = Cookie::get('offer_forms_sort_by', 'user');
    }

    /**
     * @return void
     */
    public function loadMore()
    {
        $this->limitPerPage = $this->limitPerPage + 10;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        // TODO need to finish sort by user, shared_forms, standard_forms, team_forms
        $offerForms = OfferForm::where('name', 'LIKE', "%$this->search%")
//
            ->when($this->sortBy === 'user', function ($query) {
//                $query->orderBy('users.name', 'DESC');
            })
            ->when($this->sortBy === 'manually', function ($query) {
                $query->displayOrder();
            })
            ->when($this->sortBy === 'a_z', function ($query) {
                $query->orderBy('name');
            })
            ->when($this->sortBy === 'last_opened', function ($query) {
                $query->orderBy('last_opened_at', 'DESC');
            })
            ->when($this->sortBy === 'last_modified', function ($query) {
                $query->orderBy('updated_at', 'DESC');
            })
            ->when($this->sortBy === 'shared_forms', function ($query) {
                $query->orderBy('source', 'DESC');
            })
            ->when($this->sortBy === 'team_forms', function ($query) {
                $query->orderByRaw("replace(source, 'universally-', '') desc");
            })
            ->when($this->sortBy === 'standard_forms', function ($query) {
                $query->orderBy('standard', 'DESC');
            })
            ->where(function ($query) {
                $query->where('user_id', auth()->user()->id)->orWhere('standard', 1);
            })
            ->when(auth()->user()->hasRole(['agent']), function ($query) {
                $query->active();
            })
            ->when(auth()->user()->hasRole(['super-admin', 'admin']), function ($query) {
                $query->where(function ($query) {
                    $query->whereNull('user_id')->orWhereIn('user_id', [1,2]);
                });
            })
            ->where('slug', '<>', 'standard-step-library')
            ->whereNull('parent_id')
            ->paginate($this->limitPerPage);

        return view('livewire.offer-forms.index', compact('offerForms'));
    }

    /**
     * @return void
     */
    public function changeDisplayAs($as)
    {
        $this->displayAs = $as;
        Cookie::queue('offer_forms_display_as', $as);
    }

    /**
     * @param $sortBy
     * @return void
     */
    public function changeSortBy($sortBy)
    {
        $this->sortBy = $sortBy;
        Cookie::queue('offer_forms_sort_by', $sortBy);
    }

    /**
     * @param $sortOrders
     * @return void
     */
    public function changeSortOrder($sortOrders)
    {
        $this->changeSortBy('manually');
        reorder_display_order(OfferForm::class, $sortOrders);
    }

    /**
     * @param $offerForm
     * @return void
     */
    public function activeOrInactive($id)
    {
        $offerForm = OfferForm::find($id);
        if ($offerForm) {
            $offerForm->active = !$offerForm->active;
            $offerForm->save();

            foreach (OfferForm::where('parent_id', $offerForm->id)
                         ->whereNotNull('parent_id')->get() as $step) {
                $step->update(['active' => $offerForm->active]);
            }


        }

    }

    public function recurringLogic($section, $newStep, $newLogicSection = null) {

        if(is_null($newLogicSection)) {
            // Create logic input section
            $newStep->sections()->save($newLogicSection = new OfferFormSection(Arr::except($section->toArray(), ['id', 'slug', 'offer_form_section_logic_id'])));
        }

        // Go through section logics
        foreach ($section->logics as $logic) {
            // Save logic to newly created section
            $newLogicSection->logics()->save($newLogic = new OfferFormSectionLogic(Arr::except($logic->toArray(), ['id', 'slug', 'offer_form_section_id'])));

            // Go through linked sections with logic
            foreach ($logic->linkedSections as $linkedSection) {
                $newLinkedSection = new OfferFormSection(Arr::except($linkedSection->toArray(), ['id', 'slug']));
                $newLinkedSection['offer_form_section_logic_id'] = $newLogic->id;
                $newStep->sections()->save($newLinkedSection);

                if ($linkedSection->getSubType() === 'logic') {
                    $this->recurringLogic($linkedSection, $newStep, $newLinkedSection);
                }
            }
        }
    }

    /**
     * @param $offerForm
     * @return void
     */
    public function duplicate($id)
    {
        $offerForm = OfferForm::findOrFail($id);

        $newOfferForm = Arr::except($offerForm->toArray(), ['id', 'user', 'slug']);
        $newOfferForm['name'] .= ' (Duplicate)';
        $newOfferForm['user_id'] = auth()->user()->id;

        if (auth()->user()->hasRole('agent')) {
            $newOfferForm['standard'] = 0;
        }

        $newOfferForm = OfferForm::create($newOfferForm);
        $newOfferForm->referralPartnerTypes()->attach($offerForm->referralPartnerTypes);
        foreach ($offerForm->steps as $step) {
            $newStep = new OfferForm(Arr::except($step->toArray(), ['id', 'slug', 'locked', 'active']));
            $newStep->user_id = auth()->user()->id;
            $newStep->active = (int) $step->active;
            $newStep->locked = (int) $step->locked;
            $newOfferForm->steps()->save($newStep);

            $newStep->fresh();

            foreach ($step->sections as $section) {
                if ($section->getSubType() !== 'logic' && is_null($section->offer_form_section_logic_id)) {
                    $newStep->sections()->save(new OfferFormSection(Arr::except($section->toArray(), ['id', 'slug'])));
                }
            }

            foreach ($step->sections as $section) {
                // Check if Section has logics and offer_form_section_logic_id is null
                if ($section->getSubType() === 'logic' && is_null($section->offer_form_section_logic_id)) {
                    $this->recurringLogic($section, $newStep);
                }
            }
        }
    }

    /**
     * @param $id
     * @return void
     */
    public function destroy($id)
    {
        $offerForm = OfferForm::find($id);
        if ($offerForm) {
            $this->emit('hideModal');
            $this->emit('showToast', 'Success!', 'OfferForm Deleted Successfully!');
            $offerForm->delete();
        }
    }
}
