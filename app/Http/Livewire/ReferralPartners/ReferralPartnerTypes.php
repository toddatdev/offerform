<?php

namespace App\Http\Livewire\ReferralPartners;

use App\Models\ReferralPartners\ReferralPartnerType;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Livewire\Component;

class ReferralPartnerTypes extends Component
{

    public $name;

    public $search = '';

    public $showEditModal;

    public function render()
    {
        $referralPartnerTypes = ReferralPartnerType::where('name', 'like', '%' . $this->search . '%')->get();

        return view('livewire.referral-partners.referral-partner-types', compact('referralPartnerTypes'));
    }

    protected $rules = [
        'name' => 'required|unique:referral_partner_types',
    ];

    public function addNewReferralType()
    {

        $this->showEditModal = false;

        $this->dispatchBrowserEvent('show-form');

        $this->reset();

    }

    public function createReferralPartnerType()
    {

        $this->validate();

        ReferralPartnerType::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
        ]);

        $this->dispatchBrowserEvent('hide-form');

        $this->emit('showToast', 'Success!', 'Referral partner type created successfully!');

    }

}
