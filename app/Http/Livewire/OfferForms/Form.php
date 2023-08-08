<?php

namespace App\Http\Livewire\OfferForms;

use App\Http\Livewire\Traits\CopyOFLink;
use App\Models\OfferForms\OfferForm;
use App\Models\OfferForms\OfferFormSection;
use App\Models\OfferForms\OfferFormSectionLogic;
use App\Models\ReferralPartners\ReferralPartnerType;
use App\Models\World\City;
use App\Models\World\State;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Form extends Component
{
    use CopyOFLink;

    /**
     * @var OfferForm
     */
    public ?OfferForm $offerForm;

    /**
     * @var OfferForm
     */
    public OfferForm $offerFormStep;

    /**
     * @var string
     */
    public $search = '';

    /**
     * @var string
     */
    public $searchFromLibrary = '';

    /**
     * @var string
     */
    public $displayAs = 'grid';

    /**
     * @var int
     */
    public $limitPerPage = 10;

    /**
     * @var string[]
     */
    protected $listeners = [
        'refresh-offer-forms' => '$refresh',
        'load-more' => 'loadMore'
    ];

    /**
     * @var bool
     */
    public $isEdit = false;
    /**
     * @var bool
     */
    public $isEditing = false;

    public $libraryStepsSelected = [];
    /**
     * @var \string[][]
     */
    protected $rules = [
        // Offer Form Validation
        'offerForm.name' => ['required'],
        'offerForm.description' => ['required'],

        // Step Validations
        'offerFormStep.name' => ['required'],
//            'offerForm.description' => ['required'],
    ];

    /**
     * @return void
     */
    public function mount($offerForm = null)
    {
        if ($offerForm) {
            $offerForm->last_opened_at = Carbon::now();
            $offerForm->save();
            $offerForm->fresh();

            $this->offerForm = $offerForm;
            $this->isEdit = true;
        } else {
            $this->offerForm = new OfferForm();
            $this->isEditing = true;
        }

        $this->displayAs = Cookie::get('offer_forms_step_display_as', 'grid');

        $this->offerFormStep = new OfferForm();
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        $offerFormSteps = $this->offerForm->getOfferFormStepsQuery()
            ->where('name', 'LIKE', "%$this->search%")
            ->get();

        $offerFormLibrarySteps = $this->librarySteps;
        $referralPartnerTypesLibrarySteps = $this->referralPartnerTypeLibrarySteps;
        return view('livewire.offer-forms.form', compact('offerFormSteps', 'offerFormLibrarySteps', 'referralPartnerTypesLibrarySteps'));
    }

    /**
     * @return void
     */
    public function loadMore()
    {
        $this->limitPerPage = $this->limitPerPage + 100;
    }

    /**
     * @return void
     */
    public function changeDisplayAs($as)
    {
        $this->displayAs = $as;
        Cookie::queue('offer_forms_step_display_as', $as);
    }

    /**
     * @param $v
     * @return void
     */
    public function setIsEditing($v)
    {
        $this->isEditing = $v;
    }

    /**
     * @param $sortOrders
     * @return void
     */
    public function changeSortOrder($sortOrders)
    {
        foreach ($sortOrders as $sortOrder) {
            $offerForm = OfferForm::find($sortOrder['value']);
            if ($offerForm) {
                $offerForm->update(['display_order' => $sortOrder['order']]);
            }
        }
    }

    public function getLibraryStepsProperty()
    {
        return OfferForm::whereHas('offerForm', function ($query) {
            $query->where('slug', 'standard-step-library');
        })
            ->whereNull('referral_partner_id')
            ->active()
            ->displayOrder()
            ->where('name', 'LIKE', "%$this->searchFromLibrary%")
            ->get();
    }

    public function getReferralPartnerTypeLibraryStepsProperty()
    {
        return ReferralPartnerType::whereHas('referralPartners', function ($query) {

            $query->when(auth()->user()->hasRole('agent'), function ($query) {
//                // User address components
//                $addressComponents = auth()->user()->address_components ?? [];
//
//                // Address component state
//                $stateId = State::where(function ($query) use ($addressComponents) {
//                    $query->where('name', $addressComponents['state'] ?? '')
//                        ->orWhere('iso2', $addressComponents['state'] ?? '');
//                })->where('type', 'state')->first()?->id;
//
//                // Address component city
//                $cityId = City::where('name', $addressComponents['city'] ?? '')->first()?->id;
//
//                // Address component zipcode
//                $zipcode = $addressComponents['zipcode'] ?? '';
//
                $query
//                    // Where states only
//                    ->where(function ($query) use ($stateId) {
//                        $query->whereRaw("`service_areas`->>'$.only' = 'states'")
//                            ->whereRaw("JSON_SEARCH(service_areas->>'$.states', 'one', '$stateId') is not null");
//                    })
//
//                    // Where cities only
//                    ->orWhere(function ($query) use ($cityId) {
//                        $query->whereRaw("`service_areas`->>'$.only' = 'cities'")
//                            ->whereRaw("JSON_SEARCH(service_areas->>'$.cities', 'one', '$cityId') is not null");
//                    })
//
//                    // Where zipcodes only
//                    ->orWhere(function ($query) use ($zipcode) {
//                        $query->whereRaw("`service_areas`->>'$.only' = 'zipcodes'")
//                            ->whereRaw("JSON_SEARCH(service_areas->>'$.zipcodes', 'one', '$zipcode') is not null");
//                    })
//
//                    // Service Areas from all
//                    ->orWhere(function ($query) use ($stateId, $cityId, $zipcode) {
//                        $query
//                            ->whereRaw("`service_areas`->>'$.only' is null OR `service_areas`->>'$.only' = 'all'")
//                            ->where(function ($query) use ($stateId, $cityId, $zipcode) {
//                                $query->whereRaw("JSON_SEARCH(service_areas->>'$.states', 'one', '$stateId') is not null")
//                                    ->orWhereRaw("JSON_SEARCH(service_areas->>'$.cities', 'one', '$cityId') is not null")
//                                    ->orWhereRaw("JSON_SEARCH(service_areas->>'$.zipcodes', 'one', '$zipcode') is not null");
//                            });
//                    })
                    ->has('offerForm');
            });


        })->with(['referralPartners' => function ($query) {
            $query->when(auth()->user()->hasRole('agent'), function ($query) {
//                // User address components
//                $addressComponents = auth()->user()->address_components ?? [];
//
//                // Address component state
//                $stateId = State::where(function ($query) use ($addressComponents) {
//                    $query->where('name', $addressComponents['state'] ?? '')
//                        ->orWhere('iso2', $addressComponents['state'] ?? '');
//                })->where('type', 'state')->first()?->id;
//
//                // Address component city
//                $cityId = City::where('name', $addressComponents['city'] ?? '')->first()?->id;
//
//                // Address component zipcode
//                $zipcode = $addressComponents['zipcode'] ?? '';
//
                $query
//                    // Where states only
//                    ->where(function ($query) use ($stateId) {
//                        $query->whereRaw("`service_areas`->>'$.only' = 'states'")
//                            ->whereRaw("JSON_SEARCH(service_areas->>'$.states', 'one', '$stateId') is not null");
//                    })
//
//                    // Where cities only
//                    ->orWhere(function ($query) use ($cityId) {
//                        $query->whereRaw("`service_areas`->>'$.only' = 'cities'")
//                            ->whereRaw("JSON_SEARCH(service_areas->>'$.cities', 'one', '$cityId') is not null");
//                    })
//
//                    // Where zipcodes only
//                    ->orWhere(function ($query) use ($zipcode) {
//                        $query->whereRaw("`service_areas`->>'$.only' = 'zipcodes'")
//                            ->whereRaw("JSON_SEARCH(service_areas->>'$.zipcodes', 'one', '$zipcode') is not null");
//                    })
//
//                    // Service Areas from all
//                    ->orWhere(function ($query) use ($stateId, $cityId, $zipcode) {
//                        $query
//                            ->whereRaw("`service_areas`->>'$.only' is null OR `service_areas`->>'$.only' = 'all'")
//                            ->where(function ($query) use ($stateId, $cityId, $zipcode) {
//                                $query->whereRaw("JSON_SEARCH(service_areas->>'$.states', 'one', '$stateId') is not null")
//                                    ->orWhereRaw("JSON_SEARCH(service_areas->>'$.cities', 'one', '$cityId') is not null")
//                                    ->orWhereRaw("JSON_SEARCH(service_areas->>'$.zipcodes', 'one', '$zipcode') is not null");
//                            });
//                    })
                    ->has('offerForm');
            });
        }])
            ->get();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function submit()
    {
        $this->validate([
            // Offer Form Validation
            'offerForm.name' => ['required'],
            'offerForm.description' => ['nullable'],
        ]);

        if ($this->isEdit) {
            $this->offerForm->save();
            $this->isEditing = false;
        } else {
            $this->offerForm->user_id = auth()->user()->id;
            $this->offerForm = OfferForm::create($this->offerForm->toArray());

            $this->libraryStepsSelected = [];
            foreach (OfferForm::whereHas('offerForm', function ($query) {
                $query->where('slug', 'standard-step-library');
            })->displayOrder()->where('locked', 1)->whereNull('referral_partner_id')->get() as $libraryStep) {
                $this->libraryStepsSelected[] = $libraryStep->id;
            }

            foreach ($this->referralPartnerTypeLibrarySteps as $referralPartnerTypeLibraryStep) {
                $referralPartner = $referralPartnerTypeLibraryStep->referralPartners[0] ?? null;

                if ($referralPartner && $referralPartner->offerForm->locked) {
                    $this->libraryStepsSelected[] = $referralPartner->offerForm->id;
                }
            }

            $this->submitStepsFromLibrary();

            return redirect()->to(route('dash.offer-forms.edit', $this->offerForm->slug));
        }
    }

    public function addStep()
    {
        $this->offerFormStep = new OfferForm();
    }

    public function editStep($id)
    {
        $this->offerFormStep = OfferForm::find($id);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function submitStep()
    {
        $this->validate([
            // Offer Form Validation
            'offerFormStep.name' => ['required'],
        ]);

        if ($this->offerFormStep->id) {
            $this->offerFormStep->save();

            $this->emit('showToast', 'Success!', 'OfferForm step updated successfully!');
        } else {
            $this->offerFormStep->parent_id = $this->offerForm->id;

            $this->offerFormStep = OfferForm::create($this->offerFormStep->toArray());

            $this->emit('showToast', 'Success!', 'OfferForm step added successfully!');
        }

        $this->offerFormStep = new OfferForm();

        $this->emit('hideModal');

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
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function submitStepsFromLibrary()
    {
        $referralPartnerTypeIds = [];
        if (count($this->libraryStepsSelected) > 0) {
            foreach ($this->libraryStepsSelected as $selected) {
                $step = OfferForm::find($selected);

                if ($step) {
                    if (!is_null($step->referral_partner_id)) {
                        $referralPartnerTypeIds[] = $step->referralPartner->referralPartnerType->id;
                    } else {
                        $newStep = new OfferForm(Arr::except($step->toArray(), ['id', 'slug', 'created_at', 'updated_at']));
                        $newStep->user_id = auth()->user()->id;
                        $newStep->source = 'library';
                        $newStep->library = true;
                        $newStep->library_step_id = $step->id;
                        $newStep->display_order = next_display_order(OfferForm::where('parent_id', $this->offerForm->id));
                        $this->offerForm->steps()->save($newStep);

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
            }
            $this->libraryStepsSelected = [];

            if (count($referralPartnerTypeIds) > 0) {
                $referralPartnerTypeIds = array_merge( $referralPartnerTypeIds, $this->offerForm->referralPartnerTypes->pluck('id')->toArray());
                $this->offerForm->referralPartnerTypes()->sync(array_unique($referralPartnerTypeIds));
            }
            $this->emit('offer-form-step-saved');
        }
    }

    /**
     * @param $offerFormStep
     * @return void
     */
    public function duplicate($id)
    {
        $step = OfferForm::findOrFail($id);

        $offerFormStep = Arr::except($step->toArray(), ['id', 'user', 'slug']);
        $offerFormStep['name'] .= ' (Duplicate)';

        if (auth()->user()->hasRole('agent')) {
            $newOfferForm['standard'] = 0;
        }

        // Duplicated Step
        $offerFormStepDuplicate = OfferForm::create($offerFormStep);
        $offerFormStepDuplicate->active = $offerFormStep['active'];
        $offerFormStepDuplicate->locked = $offerFormStep['locked'];
        $offerFormStepDuplicate->save();

        $offerFormStepDuplicate->fresh();

        foreach ($step->sections as $section) {
            if (!$section->has('logics') && is_null($section->offer_form_section_logic_id)) {
                $offerFormStepDuplicate->sections()->save(new OfferFormSection(Arr::except($section->toArray(),
                    ['id', 'slug'])));
            }
        }

        foreach ($step->sections as $section) {
            // Check if Section has logics and offer_form_section_logic_id is null
            if ($section->has('logics') && is_null($section->offer_form_section_logic_id)) {
                // Create logic input section
                $offerFormStepDuplicate->sections()->save($newLogicSection = new OfferFormSection(Arr::except($section->toArray(), ['id', 'slug', 'offer_form_section_logic_id'])));

                // Go through section logics
                foreach ($section->logics as $logic) {
                    // Save logic to newly created section
                    $newLogicSection->logics()->save($newLogic = new OfferFormSectionLogic(Arr::except($logic->toArray(), ['id', 'slug', 'offer_form_section_id'])));

                    // Go through linked sections with logic
                    foreach ($logic->linkedSections as $linkedSection) {
                        $newLinkedSection = new OfferFormSection(Arr::except($linkedSection->toArray(), ['id', 'slug']));
                        $newLinkedSection['offer_form_section_logic_id'] = $newLogic->id;
                        $offerFormStepDuplicate->sections()->save($newLinkedSection);
                    }
                }
            }
        }
    }

    /**
     * @param $offerFormStep
     * @return void
     */
    public function toggleStepActive($id, $toggle)
    {
        $step = OfferForm::find($id);
        if ($step) {
            $step->update(['active' => $toggle]);
        }
    }

    /**
     * @param $offerFormStep
     * @return void
     */
    public function toggleStepLocked($id, $toggle)
    {
        $step = OfferForm::find($id);
        if ($step) {
            $step->update(['locked' => $toggle]);
            OfferForm::where('library_step_id', $step->id)->update(['locked' => $toggle]);
        }
    }

    /**
     *
     * @return void
     */
    public function shareOrUnshareUniversally()
    {
        $this->offerForm->universally_shared = !$this->offerForm->universally_shared;
        $this->offerForm->universally_shared_at = now();
        $this->offerForm->save();

        $this->emit('hideModal');
        $this->emit('showToast', 'Success!', 'Universally shared settings updated successfully!');
    }

    /**
     *
     * @return void
     */
    public function shareOrUnshareWithTeam()
    {
        $team = auth()->user()->teams()->first();
        if ($team) {
            $this->offerForm->teams()->attach($team->id);
        }

        $team = auth()->user()->ownedTeams()->first();

        if ($team) {
            $this->offerForm->teams()->attach($team->id);
        }


        $this->emit('hideModal');
        $this->emit('showToast', 'Success!', 'Universally shared settings updated successfully!');
    }

    /**
     * @param $id
     * @return void
     */
    public function destroy($id)
    {
        $offerForm = OfferForm::find($id);
        if ($offerForm) {
            OfferForm::find($id)->delete();
            $this->emit('hideModal');
            $this->emit('showToast', 'Success!', 'OfferForm step has been deleted successfully!');
        }
    }
}
