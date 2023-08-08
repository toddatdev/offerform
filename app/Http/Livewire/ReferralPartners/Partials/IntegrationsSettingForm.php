<?php

namespace App\Http\Livewire\ReferralPartners\Partials;

use App\Models\ReferralPartners\ReferralPartner;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class IntegrationsSettingForm extends Component
{
    public ReferralPartner $referralPartner;

    public $state = [];

    public function mount()
    {
        $this->state = $this->referralPartner->integrations ?? [];
    }

    public function render()
    {
        return view('livewire.referral-partners.partials.integrations-setting-form');
    }

    public function saveIntegrations()
    {
        $this->resetErrorBag();

        Validator::make($this->state, [
            'zapier' => ['nullable', 'active_url'],
        ]);

        $this->referralPartner->fill([
            'integrations' => $this->state
        ])->save();

        try {
            Http::post($this->state['zapier'], [
                'first_name' => 'First Name',
                'last_name' => 'Last Name',
                'phone' => 'Phone',
                'email' => 'test@mail.com',
            ]);

            $this->emit('showToast', 'Success!', 'Integration saved successfully. And test data sent to webhook.');
        } catch (\Exception $e) {
            $this->emit('showToast', 'Error!', 'Invalid webhook unable to send test data.', 1);
        }


    }
}
