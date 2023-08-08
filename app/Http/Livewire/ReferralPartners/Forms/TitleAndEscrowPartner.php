<?php

namespace App\Http\Livewire\ReferralPartners\Forms;

use App\Models\ReferralPartners\ReferralPartner;
use App\Models\ReferralPartners\ReferralPartnerType;
use Livewire\Component;
use Livewire\WithFileUploads;

class TitleAndEscrowPartner extends Component
{
    use WithFileUploads;

    public ReferralPartner $referralPartner;
    public ReferralPartnerType $referralPartnerType;
    public $logo;

    protected $rules = [
        'logo' => ['required'],
        'referralPartner.company_name' => ['required'],
        'referralPartner.service_city' => ['required'],
        'referralPartner.fname' => ['required'],
        'referralPartner.lname' => ['required'],
        'referralPartner.company_email' => ['required'],
        'referralPartner.company_phone' => ['required'],
        'referralPartner.company_address' => ['required'],
        'referralPartner.company_city' => ['required'],
        'referralPartner.company_state' => ['required'],
        'referralPartner.company_zip_code' => ['required'],
        'referralPartner.company_bio' => ['required'],
        'referralPartner.notes' => ['required'],
    ];

    public function mount() {
        $this->referralPartner = new ReferralPartner();
        $this->referralPartnerType = request()->route('referral_partner_type');
    }

    public function render()
    {
        return view('livewire.referral-partners.forms.title-and-escrow-partner');
    }

    public function submit()
    {
        $this->validate();

        if ($this->logo) {
            $this->referralPartner->logo = $this->logo->store('referral-partners', 'public');
        }
        // create / update here
        $this->referralPartner->save();

        $this->reset();

        session()->flash('status', 'Created Successfully...');
    }
}
