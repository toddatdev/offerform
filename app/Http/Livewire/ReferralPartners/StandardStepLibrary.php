<?php

namespace App\Http\Livewire\ReferralPartners;

use App\Models\OfferForms\OfferForm;
use App\Models\ReferralPartners\ReferralPartnerType;
use Livewire\Component;

class StandardStepLibrary extends Component
{
    public $displayAs = 'grid';

    public OfferForm $offerForm;

    protected $listeners = [
        'setOfferFormSortOrder'
    ];

    public function render()
    {
        $referralPartnerTypes = $this->offerForm->referralPartnerTypes()->whereHas('referralPartners')->get();

        return view('livewire.referral-partners.standard-step-library', compact('referralPartnerTypes'));
    }

    /**
     * @param $offerFormStep
     * @return void
     */
    public function toggleStepLocked($id, $toggle)
    {
        $type = ReferralPartnerType::find($id);
        if ($type) {
            $type->update(['locked' => $toggle]);
            OfferForm::whereHas('referralPartner', function ($query) use ($type) {
                $query->where('referral_partner_type_id', $type->id);
            })
                ->whereNotNull('parent_id')
                ->update(['locked' => $toggle]);
        }
    }

    /**
     * @param $id
     * @return void
     */
    public function destroy($id)
    {
        $type = ReferralPartnerType::where('id', $id)->firstOrFail();

        if ($type) {
            $this->offerForm->referralPartnerTypes()->detach($type);
            $this->emit('hideModal');
            $this->emit('showToast', 'Success!', 'Referral Partners has been deleted successfully!');
        }
    }

    public function setOfferFormSortOrder($step, $referralPartnerType)
    {
        $step = OfferForm::find($step);
        $referralPartnerType = ReferralPartnerType::find($referralPartnerType);

        \DB::table('offer_form_referral_partner_type')->where([
            'offer_form_id' => $step->offerForm->id,
            'referral_partner_type_id' => $referralPartnerType->id,
        ])->update(['display_order' => $step->display_order - 1]);

        $this->emit('showToast', 'Success!', 'Sort order for referral partner type updated successfully.');
    }
}
