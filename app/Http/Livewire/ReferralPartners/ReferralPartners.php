<?php

namespace App\Http\Livewire\ReferralPartners;

use App\Models\ReferralPartners\ReferralPartner;
use App\Models\ReferralPartners\ReferralPartnerType;
use Illuminate\Support\Str;
use Livewire\Component;

class ReferralPartners extends Component
{
    public $showEditModal;

    public $name;

    public $search = '';

    public ReferralPartnerType $referralPartnerType;

    public function render()
    {
        $referralPartners = ReferralPartner::query()
            ->where('referral_partner_type_id', $this->referralPartnerType->id)
            ->Where('company_name','like', '%'.$this->search.'%')
            ->get();

        return view('livewire.referral-partners.referral-partners', compact('referralPartners'));
    }

    protected $rules = [

        'referralPartnerType.name' => 'required|unique:referral_partner_types,name',
    ];

    public function edit(ReferralPartnerType $referralPartnerType){

        $this->showEditModal = true;

        $this->dispatchBrowserEvent('show-form');

    }

    public function updateReferralPartnerType(ReferralPartnerType $referralPartnerType){

        $this->validate();

        $this->referralPartnerType->slug = Str::slug($this->referralPartnerType->name);

        $this->referralPartnerType->save();

        return redirect()->route('dash.referral-partners.referral-partners-by-type',$this->referralPartnerType->slug);
    }

}
