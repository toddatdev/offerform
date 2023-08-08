<?php

namespace App\Http\Livewire\OfferForms\Steps;

use App\Http\Livewire\Traits\CopyOFLink;
use App\Models\Category;
use App\Models\OfferForms\OfferForm;
use App\Models\OfferForms\OfferFormSection;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Arr;
use Laravel\Jetstream\RedirectsActions;
use Livewire\Component;
use Spatie\Browsershot\Browsershot;

class Form extends Component
{
    use CopyOFLink;

    use AuthorizesRequests;
    use RedirectsActions;

    public OfferForm $offerForm;
    public OfferForm $offerFormStep;

    public $routeIdEdit;

    public $requiredFieldMessages = [];

    protected $listeners = [
        'offer-form-refresh' => '$refresh',
    ];

    protected $rules = [
        'offerFormStep.name' => [],
    ];

    public function mount()
    {
        $this->authorize('update', $this->offerForm);

        $this->routeIdEdit = true;
    }

    public function render()
    {
        $stepSections = $this->offerFormStep->sections()->displayOrder()->get();

        $agent = $this->offerForm->getOfferFormAgent();
        return view('livewire.offer-forms.steps.form', compact('stepSections', 'agent'))
            ->layout('layouts.offer-form-step')->layoutData(['agent' => $agent]);
    }

    public function addBuyer()
    {
        $slug = uniqid();
        // First Name
        $this->addSection(
            'inputs',
            'first-name',
             $slug . '-buyer-personal-info-1',
            'First Name',
            '<h3>What is your First Name</h3>',
            '',
            'First name here'
        );

        // Last Name
        $this->addSection(
            'inputs',
            'last-name',
            $slug . '-buyer-personal-info-2',
            'Last Name',
            '<h3>What is your Last Name</h3>',
            '',
            'Last name here'
        );

        // Date
        $this->addSection(
            'inputs',
            'date',
            $slug . '-buyer-personal-info-3',
            'Birthday',
            '<h3>When is your Birthday?</h3>',
            ''
        );
    }

    public function addSection(
        $type,
        $subType = null,
        $slug = null,
        $title = null,
        $shortDescription = null,
        $description = null,
        $placeholder = null,
    ) {
        $sectionsCount = $this->offerFormStep->sections->count();

        // If no value submitted, then use the max+1 as the new value
        $next = OfferFormSection::where('offer_form_id',
            $this->offerFormStep->id)->selectRaw('IFNULL(MAX(display_order) + 1, 1) as next')->first();

        $innerConfigTypes = OfferFormSection::TYPES_CONFIG[$type];

        if (!$subType) {
            $subType = array_key_first($innerConfigTypes);
        }

        $typeConfig = Arr::except(OfferFormSection::TYPES_CONFIG[$type][$subType],
            ['short_description', 'description']);

        $typeConfig['type'] = $subType;

        if ($subType === 'image') {
            $typeConfig['title'] = 'Click Here To Edit This Photo Module';
        }

        $sectionDescriptions = Arr::only(OfferFormSection::TYPES_CONFIG[$type][$subType],
            ['short_description', 'description']);


        $this->offerFormStep->sections()->save($stepSection = new OfferFormSection([
            //            'title' => 'Section ' . ($sectionsCount + 1),
            //            'title' => 'Click here to change question title',
            'title'             => $title,
            'slug'              => $slug,
            'placeholder'       => $placeholder,
            'short_description' => $shortDescription ?? $sectionDescriptions['short_description'],
            'description'       => $description ?? $sectionDescriptions['description'],
            'type'              => $type,
            'type_config'       => $typeConfig,
            'display_order'     => $next->next,
        ]));

        if ($sectionsCount === 0) {
            redirect()->to(route('dash.offer-forms.step.edit', [$this->offerForm->slug, $this->offerFormStep->slug]));
        } else {
            $this->emit('scroll-to-bottom', "step-section-$stepSection->id");
        }

    }

    public function changeSectionSortOrder($sortOrders)
    {
        foreach ($sortOrders as $sortOrder) {
            $offerFormSection = OfferFormSection::find($sortOrder['value']);
            if ($offerFormSection) {
                $offerFormSection->update(['display_order' => $sortOrder['order']]);
            }
        }
    }

    public function goBack($back)
    {
        $this->checkFieldsAreRequired();

        if (count($this->requiredFieldMessages) === 0) {
            try {
                $link = $this->offerFormStep->getLinkToTakeScreenshot();

                if ($link) {
                    $this->offerFormStep->image = "offer-forms/step-{$this->offerFormStep->id}.png";
                    $this->offerFormStep->save();

                    Browsershot::url($link)
                        ->save(storage_path("app/public/offer-forms/step-{$this->offerFormStep->id}.png"));
                }
            } catch (\Exception $e) {
                \Log::error('Link To Take Screenshot: ' . $e->getMessage(), $e->getTrace());
            }

            $this->redirect($back);
        } else {
            $this->dispatchBrowserEvent('required-fields-needs-to-fill', ['messages' => $this->requiredFieldMessages ]);
        }

    }

    public function goNext($url) {
        $this->checkFieldsAreRequired();
        if (count($this->requiredFieldMessages) === 0) {
            $this->redirect($url);
        } else {
            $this->dispatchBrowserEvent('required-fields-needs-to-fill', ['messages' => $this->requiredFieldMessages ]);
        }
    }

    /**
     * Destroy Section
     *
     * @return void
     */
    public function destroySection($id)
    {
        $section = OfferFormSection::findOrFail($id);
        if ($section) {
            $section->delete();
            $this->emit('hideModal');
            $this->emit('showToast', 'Success!', 'Section deleted successfully!');
        }
    }

    /**
     * Destroy Buyer Personal Information Sections
     *
     * @return void
     */
    public function destroyBuyerPersonalInformationSections($slug)
    {
        OfferFormSection::where('slug', 'LIKE', substr($slug, 0, -1) . "%")->delete();
        $this->emit('hideModal');
        $this->emit('showToast', 'Success!', 'Buyer personal information sections deleted!');

    }

    public function onChangeStep()
    {
        $this->offerFormStep->save();
    }

    public function checkFieldsAreRequired() {
        $this->requiredFieldMessages = [];
        $stepSections = $this->offerFormStep->sections()->displayOrder()->get();

        foreach ($stepSections as $section) {

            if ($section->type !== 'inputs') continue;

            $data = [];
            if (is_null($section->title) || $section->title === '') {
                $data['title'] = true;
            }
            if (is_null($section->category_id)) {
                $data['category'] = true;
            }

            if (count($data) > 0) {
                $data['id'] = $section->id;
                $this->requiredFieldMessages[] = $data;
            }
        }
    }
}
