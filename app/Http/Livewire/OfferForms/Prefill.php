<?php

namespace App\Http\Livewire\OfferForms;

use App\Models\Category;
use App\Models\OfferForms\OfferForm;
use App\Models\OfferForms\OfferFormOffer;
use App\Models\OfferForms\OfferFormSection;
use App\Notifications\SendOfferFormToBuyer;
use Illuminate\Support\Facades\Cookie;
use Livewire\Component;

class Prefill extends Component
{
    public OfferFormOffer $offerFormOffer;

    public $note;

    protected $listeners = [
        'prefill-refresh' => '$refresh',
    ];

    public function render()
    {
        $agent = $this->offerFormOffer->offerForm->getOfferFormAgent();

        $sections = OfferFormSection::whereHas('offerForm', function ($query) {
                $query->where('parent_id', $this->offerFormOffer->offerForm->id);
            })
            ->where('type', 'inputs')
            ->whereNotNull('category_id')
            ->whereNull('offer_form_section_logic_id')
            ->orWhere(function ($query) {
                $query->whereNotNull('offer_form_section_logic_id')
                    ->where('type', 'inputs')
                    ->whereNotNull('category_id')
                    ->whereIn('offer_form_section_logic_id', $this->getSelectedLogics())
                    ->whereHas('offerForm', function ($query) {
                        $query->where('parent_id', $this->offerFormOffer->offerForm->id);
                    });
            })->displayOrder()

            ->get();

        $categories = Category::whereIn('id', $sections->pluck('category_id')->toArray())->get();

        return view('livewire.offer-forms.prefill', compact('agent', 'categories', 'sections'))
            ->layout('layouts.offer-form-step')->layoutData(['agent' => $agent]);
    }

    public function sendLink()
    {

        if ($this->note) {
            $this->offerFormOffer->note = $this->note;
            $this->offerFormOffer->save();
        }
        $this->offerFormOffer->selected_logics = $this->getFormDataFromCookies();
        $this->offerFormOffer->save();

        if (!is_null($this->offerFormOffer->email)) {
            mailjet_send_email_by_template([
                'Email' => $this->offerFormOffer->email,
            ], 3791851, [
                'offer_form_link' => $this->offerFormOffer->offerForm->getLink($this->offerFormOffer),
                'agent_name' => auth()->user()->full_name,
                'agent_phone' => auth()->user()->phone,
                'agent_email' => auth()->user()->email,
            ]);
        } else {
            $this->offerFormOffer->notify(new SendOfferFormToBuyer($this->offerFormOffer->offerForm->getLink($this->offerFormOffer), !is_null($this->offerFormOffer->email) ? 'mail' : 'twilio'));
        }

        $this->emit('hideModal');
        $this->emit('showToast', 'Success!', 'OfferForm has been sent successfully!');

        $this->redirect(route('dash.offer-forms.index'));
    }

    public function getSelectedLogics()
    {
        $formData = $this->getFormDataFromCookies();
        $logics = [];
        if ($formData) {
            foreach ($formData as $key => $data) {
                if (isset($data['logic'])) {
                    $logics[] = $data['logic'];
                }
            }
        }

        return $logics;
    }

    private function getFormDataFromCookies()
    {
        $formData = Cookie::get($this->offerFormOffer->offerForm->slug);

        if ($formData) {
            try {
                return json_decode($formData, true);
            } catch (\Exception $e) {
            }
        }

        return [];
    }
}
