<?php

namespace App\Http\Livewire\ReferralPartners;

use App\Models\OfferForms\OfferForm;
use App\Models\ReferralPartners\ReferralPartner;
use App\Models\ReferralPartners\ReferralPartnerType;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateOrUpdateReferralPartner extends Component
{
    use WithFileUploads;

    public $state = [];

    public $stateServiceAreas = [];

    public ReferralPartner $referralPartner;

    public $isEdit = true;

    public ReferralPartnerType $referralPartnerType;

    public $image;

    public function render()
    {
        return view('livewire.referral-partners.create-or-update-referral-partner');
    }

    public function mount()
    {

        $this->isEdit = request()->routeIs('dash.referral-partners.edit');

        if ($this->isEdit) {

            $this->state = $this->referralPartner->toArray();

        }

    }

    public function createOrUpdate()
    {
        if ($this->image) {
            $this->state['image'] = $this->image;
        }

        Validator::make($this->state, [
            'company_name' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|string|max:255',
            'phone' => 'required',
            'date_of_first_service' => 'required',
            'address' => 'required',
            'notes' => 'nullable',
            'image' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validate();

        $checkReferralPartner = null;

        if ($this->isEdit) {

            $checkReferralPartner = ReferralPartner::find($this->referralPartner->id);

            if (!is_null($checkReferralPartner)) {
                $checkReferralPartner->update([
                    'user_id' => auth()->user()->id,
                    'referral_partner_type_id' => $this->referralPartnerType->id,
                    'company_name' => $this->state['company_name'] ?? '',
                    'first_name' => $this->state['first_name'] ?? '',
                    'last_name' => $this->state['last_name'] ?? '',
                    'email' => $this->state['email'] ?? '',
                    'phone' => $this->state['phone'] ?? '',
                    'date_of_first_service' => $this->state['date_of_first_service'] ?? '',
                    'address' => $this->state['address'] ?? '',
                    'notes' => $this->state['notes'] ?? '',
                ]);
                if ($this->image) {
                    $checkReferralPartner->upload($this->image, 'image');
                    $checkReferralPartner->save();
                }
            }


            $this->emit('showToast', 'Success!', 'Referral partner information updated successfully!');

        } else {

            $checkReferralPartner =  ReferralPartner::create([
                'user_id' => auth()->user()->id,
                'referral_partner_type_id' => $this->referralPartnerType->id,
                'company_name' => $this->state['company_name'] ?? '',
                'first_name' => $this->state['first_name'] ?? '',
                'last_name' => $this->state['last_name'] ?? '',
                'email' => $this->state['email'] ?? '',
                'phone' => $this->state['phone'] ?? '',
                'date_of_first_service' => $this->state['date_of_first_service'] ?? '',
                'address' => $this->state['address'] ?? '',
                'notes' => $this->state['notes'] ?? '',
            ]);

            if ($this->image && $checkReferralPartner) {
                $checkReferralPartner->upload($this->image, 'image');
                $checkReferralPartner->save();
            }

            $stepLibrary = OfferForm::where('slug', 'standard-step-library')->first();

            if ($stepLibrary) {
                OfferForm::create([
                    'source' => 'library',
                    'parent_id' => $stepLibrary->id,
                    'name' => $checkReferralPartner->company_name,
                    'description' => $checkReferralPartner->company_name,
                    'display_order' => 1000000,
                    'active' => 0,
                    'standard' => 1,
                    'locked' => 1,
                    'created_by_id' => 1,
                    'referral_partner_id' => $checkReferralPartner->id,
                ]);

            }

            $this->referralPartnerType->offerForms()->sync([1]);

            session()->flash('success', 'Referral partner information created successfully!');

            return redirect()->route('dash.referral-partners.edit' , [$this->referralPartnerType->slug, $checkReferralPartner->id]);

        }
    }

    public function delete()
    {
        ReferralPartner::findOrFail($this->referralPartner->id)->delete();

        session()->flash('delete', 'Referral information deleted successfully!!!');

        return redirect()->route('dash.referral-partners.referral-partners-by-type',$this->referralPartnerType->slug);


        $this->emit('showToast', 'Success!', 'Referral partner information deleted successfully!');
    }

}
