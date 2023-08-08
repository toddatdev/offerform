<?php

namespace App\Http\Livewire\OfferForms\Steps;

use App\Http\Livewire\Traits\CopyOFLink;
use App\Models\Category;
use App\Models\OfferForms\OfferForm;
use App\Models\OfferForms\OfferFormOffer;
use App\Models\OfferForms\OfferFormSection;
use App\Models\OfferForms\OfferFormSubmittedSection;
use App\Models\Team;
use App\Notifications\OfferFormFilledToAgent as OfferFormHasBeenFilledToAgent;
use App\Notifications\OfferFormFilledToBuyer as OfferFormHasBeenFilledToBuyer;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Livewire\Component;

class Index extends Component
{
    use CopyOFLink;

    public OfferForm $offerForm;
    public OfferForm $offerFormStep;
    public ?OfferFormOffer $offerFormOffer = null;

    public $requiredFieldsNotFilled = [];

    public $formStepsInputs = [];

    public $routeIsEdit;
    public $routeIsPreview = false;

    public $summary = 0;

    protected $listeners = [
        'offer-form-refresh' => '$refresh',
    ];

    public function mount()
    {
        $this->routeIsPreview = request()->routeIs('dash.offer-forms.step.preview');
        $this->routeIsEdit = false;

        if ($this->offerFormOffer && $this->offerFormOffer->status) {
            abort(403, 'Offer already been submitted please ask your agent to send new link!');
        }

        if ($this->offerFormOffer && !is_null($this->offerFormStep->referral_partner_id)) {
            $this->offerFormOffer->referral_partner_id = $this->offerFormStep->referral_partner_id;
            $this->offerFormOffer->save();
        }

        $this->summary = request()->has('summary');

        if ($this->offerFormOffer && str_contains($this->offerFormOffer->slug, 'view-form-') && request()->has('clr')) {
            OfferFormSubmittedSection::where('offer_form_offer_id', $this->offerFormOffer->id)->delete();
            $this->offerFormOffer->variables = null;
            $this->offerFormOffer->save();
            $this->offerFormOffer->fresh();
        } else {
            if (Cookie::get($this->offerForm->slug) === null) {
                Cookie::queue($this->offerForm->slug, json_encode($this->offerFormOffer && $this->offerFormOffer->selected_logics ? $this->offerFormOffer->selected_logics : []));
            }
        }
    }

    public function render()
    {
        $stepSections = $this->sections;

        $formData = Cookie::get($this->offerForm->slug);

        if ($formData) {
            $formData = json_decode($formData, true);
            $this->formStepsInputs = $formData;
        }

        $agent = $this->offerFormOffer && $this->offerFormOffer->user ? $this->offerFormOffer->user : $this->offerForm->getOfferFormAgent();

        return view('livewire.offer-forms.steps.index', compact('stepSections', 'agent'))
            ->layout('layouts.offer-form-step')->layoutData(['agent' => $agent]);
    }

    public function getSelectedLogics()
    {
        $formData = $this->getFormDataFromCookies();
//        dd($formData);
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

    public function submit()
    {
        if(is_null($this->offerFormOffer->signature)) {
            $this->emit('showToast', 'Error!', 'Signing form is required please sign it before submission.', 1);
        } else {
            if (!str_contains($this->offerFormOffer->slug, 'view-form')) {
                $this->offerFormOffer->status = 1;
                $this->offerFormOffer->save();
                $this->offerFormOffer->fresh();
                $leads = $this->offerFormOffer->leads;
                if (count($leads) > 0) {
                    foreach ($leads as $lead) {
                        $referralPartner = $lead->referralPartner;
                        \Log::info('Referral Partner:', [$referralPartner]);
                        if ($referralPartner) {
                            mailjet_send_email_by_template([
                                'Email' => $referralPartner->email,
                            ], 3985392, [

                            ]);

                            $referralPartner->subscription('default')->reportUsage();

                            \Log::info('Zapier', [$referralPartner->integrations]);
                            if (isset($referralPartner->integrations['zapier'])) {

                                $data = [];

                                $sections = OfferFormSubmittedSection::where('offer_form_offer_id', $this->offerFormOffer->id)
                                    ->where('type', 'inputs')
                                    ->get();

                                foreach ($sections as $section) {
                                    $title = str_replace([' ', '-'], ['_', '_'],
                                        strtolower($section->title ?? strip_tags($section->short_description)));


                                    $title = str_replace('&nbsp;', '', $title);
                                    $title = str_replace('click_me_to_change_text', '', $title);

                                    $key = $title;

                                    $keys = array_keys($data);
                                    $i = 1;
                                    foreach ($keys as $_key) {
                                        if (str_contains($_key,  $title)) {
                                            $i++;
                                        }
                                    }

                                    if (str_contains($key, 'mortgage') || str_contains($key, 'seller')) continue;
                                    $data[$key . '_' . $i] = section_user_response($section, true, true);
                                }

                                $data['first_name'] = '-';
                                $data['last_name'] = '-';
                                $data['email'] = $this->offerFormOffer->email;
                                $data['phone'] = '-';


                                try {
                                    \Http::post($referralPartner->integrations['zapier'], $data);
                                } catch (\Exception $e) {
                                    \Log::error('Lead: ', [$e->getMessage()]);
                                }
                            }

                        }
                    }

                    if ($this->offerFormOffer->user) {
                        mailjet_send_email_by_template([
                            'Email' => $this->offerFormOffer->user->email,
                        ], 3985392, [

                        ]);
                    }

                    if (!is_null($this->offerFormOffer->email)) {
                        mailjet_send_email_by_template([
                            'Email' => $this->offerFormOffer->email,
                        ], 3985392, [

                        ]);
                    }
//                mailjet_send_email_by_template([
//                    'Email' => $this->email,
//                ], 3985392, [
//
//                ]);
                }

                // Forgot cookie data
                Cookie::queue(Cookie::forget($this->offerForm->slug));

                if ($this->offerFormOffer->user) {
                    $user = $this->offerFormOffer->user;

                    // Notify to agent
                    $user->notify(new OfferFormHasBeenFilledToAgent($this->offerFormOffer));

                    if (isset($user->notification_preferences['client_email']) && $user->notification_preferences['client_email']) {
                        // Notify to Buyer
//                    $this->offerFormOffer->notify(new OfferFormHasBeenFilledToBuyer());

                        mailjet_send_email_by_template([
                            'Email' => $this->offerFormOffer,
                        ], 3791728, [
                            'offer_form_link' => URL::temporarySignedRoute(
                                'guest.completed.pdf',
                                Carbon::now()->addMonths(3),
                                [
                                    'offerFormOffer' => $this->offerFormOffer->slug,
                                    'fte' => implode(',', OfferFormSubmittedSection::where('offer_form_offer_id', $this->offerFormOffer->id)->pluck('id')->toArray())
                                ]
                            ),
                            'agent_name' =>  $user->full_name,
                            'agent_phone_number' => $user->phone
                        ]);
                    }

                    if ($this->offerFormOffer->offerForm && !is_null($this->offerFormOffer->team_id)) {
                        $team = Team::find($this->offerFormOffer->team_id);
                        if ($team) {
                            // Notify to team manager
                            $team->user->notify(new OfferFormHasBeenFilledToAgent($this->offerFormOffer, 3792092));
                        }
                    }
                }
            }

            // Notify to browser for submitted
            $this->emit('offerform-submitted');
        }

    }

    private function getFormDataFromCookies()
    {
        $formData = Cookie::get($this->offerForm->slug, json_encode($this->offerFormOffer && $this->offerFormOffer->selected_logics ? $this->offerFormOffer->selected_logics : []));
        if ($formData) {
            try {
                return json_decode($formData, true);
            } catch (\Exception $e) {
            }
        }

        return [];
    }

    public function toggleSummary($url = null)
    {
        $this->findRequiredFieldsIfEmpty();
        if (!empty($this->requiredFieldsNotFilled)) {
            $this->emit('goto-next-step', !$this->routeIsPreview && !empty($this->requiredFieldsNotFilled));
        } else {
            $this->summary = !$this->summary;
            if ($url) {
                // Reload required to load edit modals in summary
                $this->redirect("$url?summary");
            }
        }
    }

    public function findRequiredFieldsIfEmpty()
    {
        $formData = array_filter($this->getFormDataFromCookies());

        // Delete ignored sections from logic
        if (!$this->routeIsPreview) {
            $sectionIds = $this->sectionIgnoredFromLogics->pluck('id')->toArray();

            OfferFormSubmittedSection::where([
                'offer_form_offer_id' => $this->offerFormOffer->id,
            ])->whereIn('offer_form_section_id', $sectionIds)->delete();

        }

        // cleaning up empty values
        foreach ($formData as $key => $val) {
            $formData[$key] = array_filter($val);
        }
        $formData = array_filter($formData);

        $this->requiredFieldsNotFilled = [];
        foreach ($this->sections as $section) {
//            $default = '';
            $name = str_replace('-', '_', $section->getSubType());
//
//            if ($this->offerFormOffer) {
//                $default = $this->offerFormOffer->getDefaultValueForInput($name);
//            }


            if (/*!(array_key_exists($section->id, $formData) || $default === '') && */$section->required && $this->offerFormOffer) {
                $submittedSection = OfferFormSubmittedSection::where('offer_form_section_id', $section->id)->where('offer_form_offer_id', $this->offerFormOffer->id)->first();

                if (!isset($submittedSection->user_response[$name]) || (isset($submittedSection->user_response[$name]) && $submittedSection->user_response[$name] === '')) {
                    $this->requiredFieldsNotFilled[$section->id] = $section->title ?? strip_tags($section->short_description);
                }
            }
        }

        $this->emit('requiredFieldsNotFilledUpdated', $this->requiredFieldsNotFilled);
    }

    public function gotoNextStep()
    {
        $this->findRequiredFieldsIfEmpty();

        $this->emit('goto-next-step', !$this->routeIsPreview && !empty($this->requiredFieldsNotFilled));
    }

    public function getSectionsProperty()
    {
        return OfferFormSection::where('offer_form_id', $this->offerFormStep->id)
            ->whereNull('offer_form_section_logic_id')
            ->where(function ($query) {
                $query->where(function ($query) {
                    $query
                        ->whereNotNull('title')
                        ->whereNotNull('category_id')
                        ->where('title', '<>', '')
                        ->where('type', 'inputs');
                })->orWhere('type', '<>', 'inputs');
            })
            ->orWhere(function ($query) {
                $query->whereNotNull('offer_form_section_logic_id')
                    ->whereIn('offer_form_section_logic_id', $this->getSelectedLogics())
                    ->where('offer_form_id', $this->offerFormStep->id);
            })->displayOrder()->get();
    }

    public function getSectionIgnoredFromLogicsProperty()
    {
        return OfferFormSection::where('offer_form_id', $this->offerFormStep->id)
            ->where(function ($query) {
                $query->whereNotNull('offer_form_section_logic_id')
                    ->whereNotIn('offer_form_section_logic_id', $this->getSelectedLogics());
            })
            ->displayOrder()
            ->get();
    }

    public function submitSignature($signature, $isBuyer2 = false) {
        $pathOrText = $signature;
        if (str_starts_with($signature, 'data:image/png;base64,')) {
            $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $signature));
            $pathOrText = 'signatures/' . time() . '.png';
            Storage::disk('public')->put('signatures/' . time() . '.png', $image);
        }

        if ($this->offerFormOffer) {

            if ($isBuyer2) {
                $this->offerFormOffer->signature_2 = $pathOrText ?? 'Cody Tuma';
                $this->offerFormOffer->signed_at_2 = now();
            } else {
                $this->offerFormOffer->signature = $pathOrText ?? 'Cody Tuma';
                $this->offerFormOffer->signed_at = now();
            }

            $this->offerFormOffer->save();
            $this->offerFormOffer->fresh();
        }

        $this->emit('showToast', 'Success!', 'Signature has been saved successfully.');
        $this->emit('hideModal');
    }
}
