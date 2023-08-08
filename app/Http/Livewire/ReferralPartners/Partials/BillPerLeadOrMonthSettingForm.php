<?php

namespace App\Http\Livewire\ReferralPartners\Partials;

use App\Models\ReferralPartners\ReferralPartner;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class BillPerLeadOrMonthSettingForm extends Component
{
    public ReferralPartner $referralPartner;

    public $state = [];

    public function mount()
    {
        $this->state = $this->referralPartner->billing_preferences ?? [];
    }

    public function render()
    {
        return view('livewire.referral-partners.partials.bill-per-lead-or-month-setting-form');
    }

    public function saveBillingPreferencesPerLead()
    {
        Validator::make($this->state, [
            'bill_per' => ['nullable', 'in:lead,month'],
            'bill_per_lead.cost_per_lead' => ['nullable'],
            'bill_per_lead.monthly_payment_due_date' => ['nullable'],
            'bill_per_lead.total_monthly_charge' => ['nullable'],
        ])->validateWithBag('saveBillingPreferencesPerLead');

        $this->savePreferences();
    }

    public function saveBillingPreferencesPerMonth()
    {
        Validator::make($this->state, [
            'bill_per' => ['nullable', 'in:lead,month'],
            'bill_per_month.cost_per_lead' => ['nullable'],
            'bill_per_month.monthly_payment_due_date' => ['nullable'],
            'bill_per_month.total_monthly_charge' => ['nullable'],
        ])->validateWithBag('saveBillingPreferencesPerMonth');

        $this->savePreferences();
    }

    public function savePreferences() {
        $this->referralPartner->fill([
            'billing_preferences' => $this->state
        ])->save();

        $this->emit('showToast', 'Success!', 'Billing preferences saved successfully.');
    }
}
