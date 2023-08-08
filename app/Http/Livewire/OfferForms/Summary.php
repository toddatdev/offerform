<?php

namespace App\Http\Livewire\OfferForms;

use App\Models\Category;
use App\Models\OfferForms\OfferFormSubmittedSection;
use App\Models\User;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Summary extends Component
{
    public $offerForm;
    public $offer;
    public $viewType;
    public $isPrefill = false;
    public $agent;

    public $selectedFieldsToExport = [];
    public $allSectionsIds = [];
    public $checkedAll = false;
    public $selectedLogics = [];
    public $isPdfMode;

    protected $listeners = [
        'summary-refresh'  => '$refresh',
        'export-to-zapier' => 'exportToZapier',
    ];

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

    public function mount()
    {
        if ($this->offer && $this->offer->user) {
            $this->agent = $this->offer->user;
        } elseif ($this->offerForm) {
            $this->agent = $this->offerForm->getOfferFormAgent();
        } elseif ($this->offer && $this->offer->offerForm) {
            $this->agent = $this->offer->offerForm->getOfferFormAgent();
        } else {
            $this->agent = new User();
        }

        if ($this->isPdfMode) {
            $this->selectedFieldsToExport = explode(',', request()->get('fte', []));
        }
    }

    public function getSelectedLogics()
    {
        $formData = $this->getFormDataFromCookies();
        $logics = [];
        if ($formData) {
            foreach ($formData as $key => $data) {
                if (isset($data['logic'])) {
                    $logics[] = $data['logic'];
                }
            }
        }

        return $logics;
    }

    private function getFormDataFromCookies()
    {
        $formData = Cookie::get($this->offerForm->slug);

        if ($formData) {
            try {
                return json_decode($formData, true);
            } catch (\Exception $e) {
            }
        }

        return [];
    }

    public function render()
    {
        $categories = Category::getQuery($this->agent);
        $this->allSectionsIds = [];

        $uncategorizedSections = OfferFormSubmittedSection::where('offer_form_offer_id', $this->offer->id)
                                                        ->where('type', 'inputs')
                                                        ->whereNull('category_id')
                                                        ->when($this->isPdfMode, function ($query) {
                                                            $query->whereIn('id', $this->selectedFieldsToExport);
                                                        })
                                                        ->when($this->isPrefill, function($query){
                                                            $query->whereHas('offerFormSection', function ($query) {
                                                                $query->where(function ($query) {
                                                                    $query->whereNull('offer_form_section_logic_id');
                                                                })->orWhere(function ($query) {
                                                                    $query->whereNotNull('offer_form_section_logic_id')->whereIn('offer_form_section_logic_id', $this->getSelectedLogics());
                                                                });
                                                            });
                                                        })->get();

        foreach ($uncategorizedSections as $uncategorizedSection) {
            $this->allSectionsIds[] = $uncategorizedSection->id;
        }

        $categorizedSections = [];

        foreach ($categories as $category) {
            $sections = OfferFormSubmittedSection::where('offer_form_offer_id', $this->offer->id)
                                             ->where('type', 'inputs')
                                             ->where('category_id', $category->id)
                                             ->whereNotNull('category_id')
                                             ->when($this->isPdfMode, function ($query) {
                                                $query->whereIn('id', $this->selectedFieldsToExport);
                                             })
                                             ->when($this->isPrefill && count($this->getSelectedLogics()) >  0, function($query){
                                                $query->whereHas('offerFormSection', function ($query) {
                                                    $query->where(function ($query) {
                                                        $query->whereNull('offer_form_section_logic_id');
                                                    })->orWhere(function ($query) {
                                                        $query->whereNotNull('offer_form_section_logic_id')->whereIn('offer_form_section_logic_id', $this->getSelectedLogics());
                                                    });
                                                });
                                            })
                                            ->get();
            $categorizedSections[] = [
                'category' => $category,
                'sections' => $sections,
            ];

            foreach ($sections as $section) {
                $this->allSectionsIds[] = $section->id;
            }
//
//            dd($this->getSelectedLogics());
        }

        return view('livewire.offer-forms.summary',
            compact('categories', 'uncategorizedSections', 'categorizedSections'));
    }

    public function toggleAllCheckbox()
    {
        if ($this->checkedAll) {
            $this->selectedFieldsToExport = $this->allSectionsIds;
        } else {
            $this->selectedFieldsToExport = [];
        }

        $this->emit('onChangeSelection', $this->selectedFieldsToExport);
    }

    public function onChangeCheckbox()
    {
        $selectedCount = count($this->selectedFieldsToExport);
        $allCount = count($this->allSectionsIds);

        if ($selectedCount === $allCount) {
            $this->checkedAll = true;
        } else {
            $this->checkedAll = false;
        }

        $this->emit('onChangeSelection', $this->selectedFieldsToExport);
    }

    public function getVariablesProperty()
    {
        return $this->offer->variables ?? [];
    }


    public function getLogicallySelectedSectionIdsProperty()
    {
        $formData = $this->getFormDataFromCookies();
        $logics = [];
        if ($formData) {
            foreach ($formData as $key => $data) {
                if (isset($data['logic'])) {
                    $logics[] = $data['logic'];
                }
            }
        }

        return $logics;
    }

    public function exportToZapier()
    {
        $user = auth()->user();

        if ($user->integrations && isset($user->integrations['zapier'])) {
            $data = [];

            foreach ($this->selectedFieldsToExport as $sectionId) {
                $section = OfferFormSubmittedSection::find($sectionId);
                if ($section) {
                    $title = str_replace([' ', '-'], ['_', '_'],
                        strtolower($section->title ?? strip_tags($section->short_description)));


                    $title = str_replace('&nbsp;', '', $title);
                    $title = str_replace('click_me_to_change_text', '', $title);

                    $key = $title;

                    $keys = array_keys($data);
                    $i = 1;
                    foreach ($keys as $_key) {
                        if (str_contains($_key,  $title)) {
                            $i++;
                        }
                    }

                    if (str_contains($key, 'mortgage') || str_contains($key, 'seller')) continue;
                    $data[$key . '_' . $i] = section_user_response($section, true, true);
                }
            }

            if (count($data)) {
                Http::post($user->integrations['zapier'], $data);
            }

            $this->emit('showToast', 'Success!', 'Export to Zapier successfully completed!');
        } else {
            $this->emit('showToast', 'Error!', 'Please goto your settings page and set zapier webhook!', 1);
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
}


