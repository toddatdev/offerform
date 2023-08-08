<?php

namespace App\Http\Livewire\OfferForms\Steps;

use App\Models\Category;
use App\Models\OfferForms\OfferForm;
use App\Models\OfferForms\OfferFormOffer;
use App\Models\OfferForms\OfferFormSection;
use App\Models\OfferForms\OfferFormSectionLogic;
use App\Models\OfferForms\OfferFormSubmittedSection;
use App\Models\ReferralPartners\Lead;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Format\Video\X264;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class StepSection extends Component
{
    use WithFileUploads;

    /**
     * Current Section
     *
     * @var
     */
    public $stepSection;
    public $submittedSection;

    /**
     * OfferForm Offer
     *
     * @var
     */
    public ?OfferFormOffer $offer = null;

    /**
     * Main loop index
     *
     * @var
     */
    public $loopIndex;

    /**
     * Sub Type config
     *
     * @var
     */
    public $typeConfigType;

    public $requiredFieldsNotFilled;
    /**
     *  Section main image
     *
     * @var
     */
    public $stepSectionImage;

    /**
     * Options image for inputs -> dropdown, multiple choices, checkboxes & radios
     *
     * @var
     */
    public $stepSectionOptionImage;

    /**
     * Options for inputs -> dropdown, multiple choices, checkboxes & radios
     *
     * @var array
     */
    public $subTypeOptions = [];

    /**
     * Options image for inputs -> dropdown, multiple choices, checkboxes & radios
     *
     * @var
     */
    public $stepSectionMediaImageOrVideo;

    /**
     * Config for Media -> image, video
     *
     * @var array
     */
    public $mediaConfig = [];

    public $routeIsEdit = false;
    public $routeIsPreview = false;


    public $variablesReplaceFrom = [
        '[[Agent First Name]]',
        '[[Agent Last Name]]',
        '[[Agent Full Name]]',
        '[[Buyer First Name]]',
        '[[Buyer Last Name]]',
        '[[Buyer Full Name]]',
        '[[2nd Buyer First Name]]',
        '[[2nd Buyer Last Name]]',
        '[[2nd Buyer Full Name]]',
        '[[Property Address]]',
        '[[Offer Amount]]',
        '[[Down Payment]]',
    ];

    /**
     * @var array
     */
    protected $rules = [
        'stepSection.required' => ['boolean'],
        'stepSection.title' => [],
        'stepSection.short_description' => [],
        'stepSection.description' => [],
        'stepSection.go_to_the_next' => [],
        'stepSection.category_id' => [],
        'typeConfigType' => [],
        'stepSectionImage' => [],
    ];

    /**
     * @var string[]
     */
    protected $listeners = [
        'section-changed' => 'onChangeSection',
        'form-input-changed' => 'onFormInputChange',
        'step-section-refresh' => '$refresh',
        'onChangeOfferAmountOrDownPayment',
        'requiredFieldsNotFilledUpdated'
    ];

    /**
     * @param $stepSection
     * @param $loopIndex
     *
     * @return void
     */
    public function mount($stepSection, $loopIndex, $routeIsEdit, $routeIsPreview = false, $offerFormOffer = null)
    {
        $this->routeIsEdit = $routeIsEdit;
        $this->routeIsPreview = $routeIsPreview;
        $this->stepSection = $stepSection;
        $this->loopIndex = $loopIndex;
        $this->offer = $offerFormOffer;

        /**
         * Initialize section config type & their options, etc.
         */
        if (isset($stepSection->type_config['type'])) {

            // Assign input type config type
            $this->typeConfigType = $stepSection->type_config['type'];

            // Initialize input options
            if (isset($stepSection->type_config['options'])) {
                $this->subTypeOptions = $stepSection->type_config['options'];
            }

            // Initialize media e.g. image, video config
            if (in_array($this->typeConfigType, ['image', 'video'])) {
                $this->mediaConfig = $stepSection->type_config;
            }

            // Initialize input name
            $this->name = str_replace('-', '_', $this->typeConfigType);
        }

        /**
         * Initialize submitted sections before user input their data.
         */
        if ($offerFormOffer && $this->stepSection instanceof OfferFormSection) {

            // First or new submitted section
            $this->submittedSection = OfferFormSubmittedSection::firstOrNew([
                'offer_form_offer_id' => $offerFormOffer->id,
                'offer_form_section_id' => $this->stepSection->id,
            ]);

            // Check if not exists then create
            if (!$this->submittedSection->exists /*&& !in_array($this->name, ['logic'])*/) {
                $this->submittedSection
                    ->fill(
                        [
                            'user_response' => [
                                $this->name => '',
                            ],
                        ] + Arr::except(
                            $this->stepSection->toArray(),
                            ['id', 'slug', 'active', 'go_to_the_next']
                        )
                    )->save();

                /**
                 * If their section is instance of mortgage or seller financing section
                 * then we need to create two submitted sections for offer amount and down payment
                 * respectively. Else procedure will be same.
                 */
                if (in_array($this->name, ['mortgage_calculator', 'seller_financing'])) {
                    //                    $this->typeConfigType

                    $offerAmount = OfferFormSubmittedSection::firstOrNew([
                        'offer_form_offer_id' => $offerFormOffer->id,
                        'offer_form_section_id' => $this->stepSection->id,
                        'slug' => $this->typeConfigType . "-{$this->submittedSection->id}-offer-amount",
                    ]);
                    $dollarAmountTypeConfig = Arr::except(OfferFormSection::TYPES_CONFIG['inputs']['dollar-amount'],
                        ['short_description', 'description']);
                    $dollarAmountTypeConfig['type'] = 'dollar-amount';
                    if (!$offerAmount->exists) {
                        $offerAmount->fill(
                            [
                                'title' => 'Offer Amount',
                                'type_config' => $dollarAmountTypeConfig,
                                'user_response' => [
                                    'dollar_amount' => '',
                                ],
                            ] + Arr::except(
                                $this->stepSection->toArray(),
                                ['id', 'slug', 'active', 'go_to_the_next', 'title', 'type_config']
                            )
                        )->save();
                    }

                    $downPayment = OfferFormSubmittedSection::firstOrNew([
                        'offer_form_offer_id' => $offerFormOffer->id,
                        'offer_form_section_id' => $this->stepSection->id,
                        'slug' => $this->typeConfigType . "-{$this->submittedSection->id}-down-payment",
                    ]);

                    if (!$downPayment->exists) {
                        $downPayment->fill(
                            [
                                'title' => 'Down Payment',
                                'type_config' => $dollarAmountTypeConfig,
                                'user_response' => [
                                    'dollar_amount' => '',
                                ],
                            ] + Arr::except(
                                $this->stepSection->toArray(),
                                ['id', 'slug', 'active', 'go_to_the_next', 'title', 'type_config']
                            )
                        )->save();
                    }
                }

            }

        } elseif ($offerFormOffer && $this->stepSection instanceof OfferFormSubmittedSection) {
            // if already submitted section initialize then assign
            $this->submittedSection = $this->stepSection;
        }
    }

    public function requiredFieldsNotFilledUpdated($requiredFieldsNotFilled) {
        $this->requiredFieldsNotFilled = $requiredFieldsNotFilled;
    }
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        if ($this->routeIsEdit) {
            \Cookie::queue(\Cookie::forget($this->stepSection->offerForm->offerForm->slug));
        }

        $logics = $this->stepSection instanceof OfferFormSection ? $this->stepSection->logics()->displayOrder()->get() : [];
        return view('livewire.offer-forms.steps.step-section', compact('logics'));
    }

    /**
     * Update section when change
     *
     * @return void
     */
    public function onChangeSection()
    {
        $typeConfig = Arr::except(OfferFormSection::TYPES_CONFIG[$this->stepSection->type][$this->typeConfigType],
            ['short_description', 'description']);

        if ($this->stepSection->type_config['type'] !== $this->typeConfigType) {

            if ($this->stepSection->type_config['type'] === 'date') {
                $this->emit('remove-el', "calendar{$this->stepSection->id}");
            }

            if ($this->stepSection->type_config['type'] === 'dollar_amount') {
                $this->emit('remove-el', "dollar-amount{$this->stepSection->id}");
            }

            $typeConfig['type'] = $this->typeConfigType;
            $sectionDescriptions = Arr::only(OfferFormSection::TYPES_CONFIG[$this->stepSection->type][$this->typeConfigType],
                ['short_description', 'description']);

            if (
                str_contains(strip_tags($this->stepSection->short_description), 'CLICK ME TO CHANGE TEXT') &&
                str_contains(strip_tags($this->stepSection->description), 'CLICK ME TO CHANGE TEXT')
            ) {
                $this->stepSection->short_description = $sectionDescriptions['short_description'];
                $this->stepSection->description = $sectionDescriptions['description'];
            }

            $this->stepSection->type_config = $typeConfig;

            $this->subTypeOptions = [];
            $this->mediaConfig = [];

            if (in_array($this->typeConfigType, ['mortgage-calculator', 'seller-financing', 'cost-calculator'])) {
                $category = Category::where('slug', 'key-offer-terms')->first();
                if ($category) {
                    $this->stepSection->category_id = $category->id;
                }
            }
        }

        if (is_string($this->stepSection->title) && $this->stepSection->title === '') {
            $this->stepSection->title = null;
        }

        $this->stepSection->save();
        $this->stepSection->load('category');
        $this->stepSection->fresh();

        $this->emit('refresh-ckeditor',
            "stepSection_short_description{$this->stepSection->id}",
            $this->stepSection->short_description
        );

        $this->emit('refresh-ckeditor',
            "stepSection_description{$this->stepSection->id}",
            $this->stepSection->description
        );
    }


    public function onChangeSectionTypeConfig($key, $val)
    {
        $typeConfig = $this->stepSection->type_config;
        $typeConfig[$key] = $val;
        $this->stepSection->type_config = $typeConfig;

        $this->stepSection->save();
    }

    /**
     * On Change Section Category
     *
     * @param int $id
     *
     * @return void
     */
    public function onChangeSectionCategory($id)
    {
        $this->stepSection->category_id = $id;

        $this->onChangeSection();
    }

    /**
     * Push or pop options item of inputs
     *
     * @param string $v
     * @param int $index
     *
     * @return void
     */
    public function pushOrPopNewOptionToSubTypeOptions(string $v = 'push', int $index = 0)
    {
        if ($v === 'push') {
            $this->subTypeOptions[] = [
                'text' => '',
            ];
        } else {
            unset($this->subTypeOptions[$index]);
        }

        $this->onChangeSection();
    }

    /**
     * Update inputs on change
     *
     * @param string $v
     * @param int $index
     *
     * @return void
     */
    public function onChangeInputs()
    {
        $this->stepSection->type_config = array_merge($this->stepSection->type_config,
            ['options' => $this->subTypeOptions]);
        $this->onChangeSection();
    }

    /**
     * Update media on change
     *
     * @param string $v
     * @param int $index
     *
     * @return void
     */
    public function onChangeMedia($mediaType = 'image')
    {
        $typeConfig = $this->stepSection->type_config;
        if (isset($typeConfig['video'])) {
            unset($typeConfig['video']);
        }

        if (isset($typeConfig['youtube'])) {
            unset($typeConfig['youtube']);
        }

        $this->stepSection->type_config = array_merge($typeConfig, $this->mediaConfig);
        $this->onChangeSection();
    }

    /**
     * Update image on change of current section
     *
     * @param string $v
     *
     * @return void
     */
    public function onChangeSectionImage(string $v = 'set')
    {
        if ($this->stepSectionImage && $v === 'set') {
            $this->stepSection->image = $this->stepSectionImage->store('offer-forms/section', 'public');
        } elseif ($v === 'remove') {
            if (File::exists(storage_path("app/public/{$this->stepSection->image}"))) {
                File::delete(storage_path("app/public/{$this->stepSection->image}"));
            }
            $this->stepSection->image = null;
        }

        $this->onChangeSection();
    }

    public function changeSectionInputOptionsSortOrder($sortOrders)
    {
        $sortedOptions = [];

        foreach ($sortOrders as $sortOrder) {
            $sortedOptions[$sortOrder['order'] - 1] = $this->subTypeOptions[(int)$sortOrder['value']];
        }

        $this->subTypeOptions = $sortedOptions;

        $this->onChangeInputs();

        $this->emit('offer-form-refresh');
    }

    /**
     * Update image on change of inputs options image
     *
     * @param $index
     * @param string $v
     *
     * @return void
     */
    public function onChangeSectionOptionImage($index, string $v = 'set')
    {
        if ($this->stepSectionOptionImage && $v === 'set') {
            if (isset($this->subTypeOptions[$index]['image'])) {
                if (File::exists(storage_path("app/public/{$this->subTypeOptions[$index]['image']}"))) {
                    File::delete(storage_path("app/public/{$this->subTypeOptions[$index]['image']}"));
                }
            }
            $this->subTypeOptions[$index]['image'] = $this->stepSectionOptionImage->store('offer-forms/section',
                'public');
        } elseif ($v === 'remove' && isset($this->subTypeOptions[$index]['image'])) {
            if (File::exists(storage_path("app/public/{$this->subTypeOptions[$index]['image']}"))) {
                File::delete(storage_path("app/public/{$this->subTypeOptions[$index]['image']}"));
            }
            unset($this->subTypeOptions[$index]['image']);
        }

        $this->onChangeInputs();
    }

    /**
     * Update image on change of inputs options image
     *
     * @param string $media
     * @param string $v
     *
     * @return void
     */
    public function onChangeSectionMediaImageOrVideo(string $media = 'image', string $v = 'set')
    {
        if ($this->stepSectionMediaImageOrVideo && $v === 'set') {

            $this->validate([
                'stepSectionMediaImageOrVideo' => $media === 'image' ? 'required|image|mimes:jpg,jpeg,png|max:5000' : 'required|file|mimes:mp4,avi,mov,mkv,mpg,mpeg,webm|max:8589931',
            ], [], [
                'stepSectionMediaImageOrVideo' => $media,
            ]);

            if (isset($this->mediaConfig[$media])) {
                if (File::exists(storage_path("app/public/{$this->mediaConfig[$media]}"))) {
                    File::delete(storage_path("app/public/{$this->mediaConfig[$media]}"));
                }
            }
            $this->mediaConfig[$media] = $this->stepSectionMediaImageOrVideo->store('offer-forms/section', 'public');

            $pathInfoExt = pathinfo($this->mediaConfig[$media], PATHINFO_EXTENSION);

            if ($media === 'video') {
                if ($pathInfoExt !== 'mp4') {
                    // Convert video to mp4
                    FFMpeg::fromDisk('public')
                        ->open($this->mediaConfig[$media])
                        // add the 'resize' filter...
//                        ->addFilter(function ($filters) {
//                            $filters->resize(new Dimension(960, 540));
//                        })
                        ->export()
                        ->inFormat((new X264('aac', 'libx264'))->setKiloBitrate(500))
                        ->save(str_replace($pathInfoExt, 'mp4', $this->mediaConfig[$media]));

                    // Delete old file
                    if (Storage::disk('public')->exists($this->mediaConfig[$media])) {
                        Storage::disk('public')->delete($this->mediaConfig[$media]);
                    }

                    // Update in database
                    $this->mediaConfig[$media] = str_replace($pathInfoExt, 'mp4', $this->mediaConfig[$media]);
                }
                // Generate video thumbnail
                FFMpeg::fromDisk('public')
                    ->open($this->mediaConfig[$media])
                    ->getFrameFromSeconds(1)
                    ->export()
                    ->save(str_replace('.mp4', '.png', $this->mediaConfig[$media]));


                Log::info('log data',[$this->mediaConfig[$media]]);

                unset($this->mediaConfig['youtube']);
            }
        } elseif ($v === 'remove' && isset($this->mediaConfig[$media])) {
            if (File::exists(storage_path("app/public/{$this->mediaConfig[$media]}"))) {
                File::delete(storage_path("app/public/{$this->mediaConfig[$media]}"));
            }
            unset($this->mediaConfig[$media]);
        }

        $this->onChangeMedia();
    }

    /**
     * Section get to the next line text
     *
     * @param $v
     *
     * @return void
     */
    public function goToTheNext($v = null)
    {
        $this->stepSection->go_to_the_next = $v;
        $this->onChangeSection();
    }

    /**
     * Duplicate the section
     *
     * @return void
     */
    public function duplicate()
    {
        $section = Arr::except($this->stepSection->toArray(), ['id', 'slug']);
        $section['title'] .= ' (Duplicate)';
        $section['display_order'] += 1;

        OfferFormSection::create($section);
        $this->emit('offer-form-refresh');
    }


    /**
     * ====================================================================
     * Section Logic Management
     *
     */
    public function addLogic()
    {
        $this->stepSection->logics()->save(new OfferFormSectionLogic([
            'offer_form_section_id' => $this->stepSection->id,
            'name' => '',
        ]));

        $this->stepSection->fresh();
        $this->stepSection->load('logics');
    }

    public function onChangeLogic($id, $name)
    {
        $logic = OfferFormSectionLogic::find($id);
        if ($logic) {
            $logic->name = $name;
            $logic->save();
        }
        $this->stepSection->load('logics');
    }

    public function onChangeLogicToSection($id, $sectionId)
    {
        $section = OfferFormSection::find($sectionId);

        if ($section) {
            if ($section->offer_form_section_logic_id) {
                $section->offer_form_section_logic_id = null;
            } else {
                $section->offer_form_section_logic_id = $id;
            }
            $section->save();
        }

        $this->stepSection->load('logics');

        $this->emit('step-section-refresh');
    }

    public function onDeleteLogic($id)
    {
        $logic = OfferFormSectionLogic::findOrFail($id);
        $logic->delete();
        $this->stepSection->load('logics');

        $this->emit('step-section-refresh');
    }

    /**
     * @param $sortOrders
     *
     * @return void
     */
    public function changeSectionLogicSortOrder($sortOrders)
    {
        foreach ($sortOrders as $sortOrder) {
            $logic = OfferFormSectionLogic::findOrFail($sortOrder['value']);

            if ($logic) {
                $logic->update(['display_order' => $sortOrder['order']]);
            }
        }
    }

    /**
     * ====================================================================
     * Preview & Form Submission Actions
     *
     */

    public function getVariablesReplaceToProperty()
    {
        if ($this->offer) {
            return $this->offer->variablesReplaceToValues();
        }

        return [];
    }

    public $formFile;

    // Name of the input
    public $name;

    public function onChangeOfferAmountOrDownPayment($offerAmount, $downPayment)
    {
        if ($this->offer) {
            $offerAmountSection = OfferFormSubmittedSection::where([
                'offer_form_offer_id' => $this->offer->id,
                'offer_form_section_id' => $this->stepSection->id,
                'slug' => $this->typeConfigType . "-{$this->submittedSection->id}-offer-amount",
            ])->first();
            if (!$offerAmountSection && $this->stepSection instanceof OfferFormSubmittedSection) {
                $offerAmountSection = OfferFormSubmittedSection::where([
                    'offer_form_offer_id' => $this->offer->id,
                    'offer_form_section_id' => $this->stepSection->offer_form_section_id,
                    'slug' => $this->typeConfigType . "-{$this->stepSection->id}-offer-amount",
                ])->first();
            }

            if ($offerAmountSection) {
                $offerAmountSection->update([
                    'user_response' => [
                        'dollar_amount' => $offerAmount,
                    ],
                ]);
            }

            $downPaymentSection = OfferFormSubmittedSection::where([
                'offer_form_offer_id' => $this->offer->id,
                'offer_form_section_id' => $this->stepSection->id,
                'slug' => $this->typeConfigType . "-{$this->submittedSection->id}-down-payment",
            ])->first();

            if (!$downPaymentSection && $this->stepSection instanceof OfferFormSubmittedSection) {
                $downPaymentSection = OfferFormSubmittedSection::where([
                    'offer_form_offer_id' => $this->offer->id,
                    'offer_form_section_id' => $this->stepSection->offer_form_section_id,
                    'slug' => $this->typeConfigType . "-{$this->stepSection->id}-down-payment",
                ])->first();
            }

            if ($downPaymentSection) {
                $downPaymentSection->update([
                    'user_response' => [
                        'dollar_amount' => $downPayment,
                    ],
                ]);
            }
        }

    }

    public function onFormInputChange($name, $value, $setVar = true, $notify = true)
    {
        if ($this->routeIsEdit) {
            if (!in_array($this->typeConfigType, ['cost-calculator', 'mortgage-calculator', 'seller-financing'])) {
                $this->stepSection->placeholder = $value;
            }
            $this->onChangeSection();

            $notify && $this->emit('offer-form-refresh');
        } else {
            if ($this->offer && $setVar) {
                $variables = $this->offer->variables ?? [];

                switch ($name) {
                    case 'first_name':
                        $variables[OfferFormOffer::VAR_FORM_FIRST_NAME] = $value;
                        break;
                    case 'last_name':
                        $variables[OfferFormOffer::VAR_FORM_LAST_NAME] = $value;
                        break;
                    case 'address':
                        $variables[OfferFormOffer::VAR_FORM_ADDRESS] = $value;
                        break;
                }

                $this->offer->variables = array_filter($variables);
                $this->offer->save();
            }

            if ($this->offer) {
                $v = $value;
                if ($name === 'logic') {
                    $logic = OfferFormSectionLogic::find($value);
                    if ($logic) {
                        $v = $logic->name;
                    }
                }

                if ($name === 'lead_activation' && !is_null($this->offer->referral_partner_id)) {
                   if ((int) $value === 1) $this->offer->leads()->save(new Lead(['referral_partner_id' => $this->offer->referral_partner_id]));
                   else {
                       $this->offer->leads()->where('referral_partner_id', $this->offer->referral_partner_id)->delete();
                   };
                }

                $this->submittedSection->fill([
                    'user_response' => [
                        $name => $v,
                    ],
                ])->save();
            }

            if (in_array($name, ['logic'])) {
                $slug = $this->stepSection->offerForm->offerForm->slug;
                $formInputs = Cookie::get($slug, json_encode($this->offer && $this->offer->selected_logics ? $this->offer->selected_logics : []));

                if ($formInputs) {
                    $formInputs = json_decode($formInputs, true);
                }

                if (isset($formInputs[$this->stepSection->id][$name]) && ($value === -1 || $value !== $formInputs[$this->stepSection->id][$name])) {
                    $this->hideChildLogics($formInputs[$this->stepSection->id][$name], $formInputs);

                }
                $formInputs[$this->stepSection->id][$name] = addslashes($value);


                Cookie::queue($slug, json_encode($formInputs));

            }
            $this->emit('summary-refresh');
        }

        if (in_array($name, ['logic'])) {
            $notify && $this->emit('offer-form-refresh');
            $notify && $this->emit('clear-prefill');
        }
    }

    public function hideChildLogics($logicId, &$formInputs) {
        $logicSections = OfferFormSection::where('offer_form_section_logic_id', $logicId)->where('type_config->type', 'logic')->get();
        if (count($logicSections) > 0) {
            foreach ($logicSections as $logicSection) {
                if (isset($formInputs[$logicSection->id]['logic']) && ($logicId = $formInputs[$logicSection->id]['logic'])) {
                    $formInputs[$logicSection->id]['logic'] = -1;
                    $this->hideChildLogics($logicId, $formInputs);
                }
            }
        }
    }

    public function onFormFileUpload()
    {
        $newFiles = [];
        $oldFiles = $this->defaultOrValue;

        // Compatibility
        if ($oldFiles === '') {
            $oldFiles = [];
        } elseif (!is_array($oldFiles) && $oldFiles !== '') {
            $oldFiles = [$oldFiles];
        }


        //        $file = offer_form_steps_input_value($this->stepSection->offerForm->offerForm->slug, $this->stepSection->id,
        //            'file');

        $chosenFiles = $this->formFile;
        if (!is_null($chosenFiles) && !is_array($chosenFiles)) {
            $chosenFiles = [$chosenFiles];
        }
        if (!is_null($chosenFiles)) {
            foreach ($oldFiles as $oldFile) {
                if ($oldFile !== '') {
                    if (File::exists(storage_path("app/public/{$oldFile['download_link']}"))) {
                        File::delete(storage_path("app/public/{$oldFile['download_link']}"));
                    }
                }
            }
            foreach ($chosenFiles as $chosenFile) {
                $newFiles[] = [
                    'download_link' => $chosenFile->store('offer-forms', 'public'),
                    'original_name' => $chosenFile->getClientOriginalName(),
                ];
            }

            $this->onFormInputChange('file_upload', $newFiles);
        }
    }

    public function getDefaultOrValueProperty()
    {
        $value = '';

        if ($this->offer) {
            $value = $this->offer->getDefaultValueForInput($this->name, $this->stepSection->type_config);

            if ($this->submittedSection && (!isset($this->submittedSection->user_response[$this->name]) || (isset($this->submittedSection->user_response[$this->name]) && $this->submittedSection->user_response[$this->name] === ''))) {
                $this->submittedSection->user_response = [
                    $this->name => $value,
                ];
                $this->submittedSection->save();
            }

            if ($this->name === 'e_signature') {
                $value = $this->submittedSection->user_response;
            } else {
                $value = $this->submittedSection->user_response[$this->name] ?? '';
            }

        }

        return $value;
    }

    public function submitSignature($signature, $isBuyer2 = false) {
        $pathOrText = $signature;
        if (str_starts_with($signature, 'data:image/png;base64,')) {
            $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $signature));
            $pathOrText = 'signatures/' . time() . '.png';
            Storage::disk('public')->put('signatures/' . time() . '.png', $image);
        }


        if ($this->submittedSection) {
            $this->submittedSection->user_response = [
                'e_signature' => $pathOrText ?? 'Cody Tuma',
                'signed_at' => now()
            ];
            $this->submittedSection->save();
        }

        $this->emit('showToast', 'Success!', 'Signature has been saved successfully.');
        $this->emit('hideModal');
    }
}
