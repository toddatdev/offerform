<?php

namespace App\Http\Livewire\ReferralPartners\Partials;

use App\Models\ReferralPartners\ReferralPartner;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class PaymentMethodSettingForm extends Component
{
    public ReferralPartner $referralPartner;

    public $state = [];

    public $clientSecret;

    public function mount() {
        $this->state = $this->referralPartner->payment_methods ?? [];
        $this->clientSecret = $this->referralPartner->createSetupIntent()->client_secret;
    }

    public function render()
    {
        return view('livewire.referral-partners.partials.payment-method-setting-form');
    }

    public function savePaymentMethods() {
        Validator::make($this->state, [
        ])->validateWithBag('savePaymentMethods');

        $this->referralPartner->fill([
            'payment_methods' => $this->state
        ])->save();

        $this->referralPartner->newSubscription('default', [])
            ->meteredPrice(ReferralPartner::SUBSCRIPTION_STRIPE_PLAN)
            ->create($this->state['payment_method']);

        $this->emit('showToast', 'Success!', 'Payment methods saved successfully.');
    }
}
