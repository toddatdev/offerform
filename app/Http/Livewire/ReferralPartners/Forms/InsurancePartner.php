<?php

namespace App\Http\Livewire\ReferralPartners\Forms;

use App\Models\ReferralPartners\ReferralPartner;
use Livewire\Component;
use Livewire\WithFileUploads;

class InsurancePartner extends Component
{
    use WithFileUploads;

    public ReferralPartner $referralPartner;
    public $logo;

    protected $rules = [

    ];
    public function render()
    {
        return view('livewire.referral-partners.forms.insurance-partner')->withReferralPartnerType(request()->route('referral_partner_type'));
    }

    public function submit() {
        $this->validate();

        // create / update here

        $this->reset();

        session()->flash('status', 'We received your query successfully. One of our team member will get back to you as soon as possible.');
    }
}
