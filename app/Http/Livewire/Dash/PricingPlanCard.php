<?php

namespace App\Http\Livewire\Dash;

use App\Models\Pages\PricingPlan;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class PricingPlanCard extends Component
{
    public PricingPlan $pricingPlan;

    public $state = [];

    public function render()
    {
        return view('livewire.dash.pricing-plan-card');
    }

    public function update()
    {
        $validatedDate = $this->validate([
            'title' => 'required',
        ]);

        $pricingPlan = PricingPlan::find($this->pricingPlan->id);

        $pricingPlan->update([
            'title' => $this->pricingPlan->title,
            'tagline' => $this->pricingPlan->tagline,
            'features' => $this->pricingPlan->features,
        ]);

        $this->updateMode = false;

        session()->flash('message', 'Pricing Plan Updated Successfully.');

        return back();
    }

    public function edit($id)
    {

//        $record = Contact::findOrFail($id);
//        $this->selected_id = $id;
//        $this->name = $record->name;
//        $this->email = $record->email;
//        $this->updateMode = true;
    }
}
