<?php

namespace App\Http\Livewire\OfferForms;

use App\Models\OfferForms\OfferForm;
use App\Models\OfferForms\OfferFormSection;
use App\Models\OfferForms\OfferFormSectionLogic;
use Illuminate\Support\Arr;
use Livewire\Component;

class AddSharedFormModal extends Component
{

    /**
     * @var string
     */
    public $search = '';

    public $selectedForms = [];

    public function render()
    {
        $offerForms = OfferForm::where(function ($query) {
                $query->where('name', 'LIKE', "%$this->search%")
                    ->orWhereHas('user', function ($query) {
                        $query->where('first_name', 'LIKE', "%$this->search%")
                            ->orWhere('last_name', 'LIKE', "%$this->search%");
                    });
            })
            ->whereNull('parent_id')
            ->where('universally_shared', true)
            ->get();
        return view('livewire.offer-forms.add-shared-form-modal', compact('offerForms'));
    }

    public function recurringLogic($section, $newStep, $newLogicSection = null)
    {

        if (is_null($newLogicSection)) {
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

    public function addForm()
    {
        if (count($this->selectedForms) > 0) {
            foreach ($this->selectedForms as $selected) {
                $selectForm = OfferForm::find($selected);

                if ($selectForm) {
                    $newForm = new OfferForm(Arr::except($selectForm->toArray(), ['id', 'slug']));
                    $newForm->user_id = auth()->user()->id;
                    $newForm->source = 'universally-shared';
                    $newForm->universally_shared = false;
                    $newForm->save();

                    foreach ($selectForm->steps as $step) {
                        if ($step) {
                            $newStep = new OfferForm(Arr::except($step->toArray(), ['id', 'slug']));
                            $newStep->user_id = auth()->user()->id;
                            $newForm->steps()->save($newStep);

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

            }
            $this->emitUp('offerforms-refresh');
            $this->emit('hideModal');
            $this->emit('showToast', 'Success!', 'Form added successfully!');
        }
    }

    public function editForms()
    {
        $formsLinks = [];
        foreach ($this->selectedForms as $selected) {
            $selectForm = OfferForm::find($selected);
            if ($selectForm) {
                $formsLinks[] = route('dash.offer-forms.edit', $selectForm->slug);
            }
        }

        $this->emit('edit-shared-space-forms', $formsLinks);
    }

    public function destroy()
    {
        OfferForm::whereIn('id', $this->selectedForms)
            ->whereNull('parent_id')
            ->update(['universally_shared' => false]);

        $this->reset('search');
        $this->reset('selectedForms');
        $this->emit('showToast', 'Success!', 'Selected forms has been remove from shared space successfully.');
    }
}
