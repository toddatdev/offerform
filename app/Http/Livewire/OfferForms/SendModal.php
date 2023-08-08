<?php

namespace App\Http\Livewire\OfferForms;

use App\Models\OfferForms\OfferFormOffer;
use App\Notifications\SendOfferFormToBuyer;
use App\Rules\YoutubeUrlIsValid;
use FFMpeg\Format\Video\X264;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class SendModal extends Component
{
    use WithFileUploads;

    public $by;

    public $offerForm;

    public $propertyAddress;
    public $firstName;
    public $lastName;
    public $email;
    public $phone;
    public $additionalBuyerFirstName;
    public $additionalBuyerLastName;
    public $addressComponents;

    public $youtube;

    public $video;

    public $additionalBuyer = false;

    public function mount($by, $offerForm)
    {
        $this->by = $by;
        $this->offerForm = $offerForm;
    }

    public function render()
    {
        return view('livewire.offer-forms.send-modal');
    }

    public function sendLink($prefill = false)
    {
        $this->validate([
            strtolower($this->by) => ['required'],
            'youtube' => ['nullable', 'url', new YoutubeUrlIsValid],
            'video' => ['nullable', 'file', 'mimes:mp4,avi,mov,mkv,mpg,mpeg,webm', 'max:8589931']
        ]);

        $buyerOffer = $this->offerForm->getNewOffer([
            strtolower($this->by) => $this->{strtolower($this->by)},
        ]);

        if ($this->video) {
            $buyerOffer->upload($this->video, 'video')->save();
            $buyerOffer->fresh();

            $pathInfoExt = pathinfo($buyerOffer->video, PATHINFO_EXTENSION);
            if ($pathInfoExt !== 'mp4') {
                // Convert video to mp4
                FFMpeg::fromDisk('public')
                    ->open($buyerOffer->video)
                    // add the 'resize' filter...
                    ->export()
                    ->inFormat((new X264('aac', 'libx264'))->setKiloBitrate(500))
                    ->save(str_replace($pathInfoExt, 'mp4', $buyerOffer->video));

                // Delete old file
                if (Storage::disk('public')->exists($buyerOffer->video)) {
                    Storage::disk('public')->delete($buyerOffer->video);
                }

                // Update in database
                $buyerOffer->video = str_replace($pathInfoExt, 'mp4', $buyerOffer->video);
            }

            // Generate video thumbnail
            FFMpeg::fromDisk('public')
                ->open($buyerOffer->video)
                ->getFrameFromSeconds(1)
                ->export()
                ->save(str_replace('.mp4', '.png', $buyerOffer->video));

            $buyerOffer->save();
        }

        if ($this->youtube) {
            $buyerOffer->video = $this->youtube;
            $buyerOffer->save();
        }

        $variables = $buyerOffer->variables ?? [];
        $variables[OfferFormOffer::VAR_BUYER_FIRST_NAME] = $this->firstName;
        $variables[OfferFormOffer::VAR_BUYER_LAST_NAME] = $this->lastName;
        $variables[OfferFormOffer::VAR_ADDITIONAL_BUYER_FIRST_NAME] = $this->additionalBuyerFirstName;
        $variables[OfferFormOffer::VAR_ADDITIONAL_BUYER_LAST_NAME] = $this->additionalBuyerLastName;
        $variables[OfferFormOffer::VAR_PROPERTY_ADDRESS] = $this->propertyAddress;
        $variables[OfferFormOffer::VAR_AGENT_FIRST_NAME] = auth()->user()->first_name;
        $variables[OfferFormOffer::VAR_AGENT_LAST_NAME] = auth()->user()->last_name;

        $buyerOffer->variables = array_filter($variables);
        $buyerOffer->address_components = $this->addressComponents ?? auth()->user()->address_components;

        $buyerOffer->save();

        if (!$prefill) {
            if ($this->by === 'Email') {
//            {{var:offer_form_link:''}}
                mailjet_send_email_by_template([
                    'Email' => $this->{strtolower($this->by)},
                    'Name' => "$this->firstName $this->lastName",
                ], 3791851, [
                    'offer_form_link' => $this->offerForm->getLink($buyerOffer),
                    'agent_name' => auth()->user()->full_name,
                    'agent_phone' => auth()->user()->phone,
                    'agent_email' => auth()->user()->email,
                ]);
            } else {
                $buyerOffer->notify(new SendOfferFormToBuyer($this->offerForm->getLink($buyerOffer), $this->by === 'Email' ? 'mail' : 'twilio'));
            }


            $this->emit('hideModal');
            $this->emit('showToast', 'Success!', 'OfferForm has been sent successfully!');

            $this->resetExcept([
                'by',
                'offerForm',
                'propertyAddress',
                'additionalBuyer'
            ]);
        } else {
            $this->redirect(route('dash.offer-forms.prefill', $buyerOffer));
        }
    }

    public function prefill()
    {
        $this->sendLink(true);
    }

    public function attachVideo()
    {
        $this->validate([
            strtolower($this->by) => ['required'],
        ]);
        $this->emit('send-modal-attach-video', "{$this->by}{$this->offerForm->id}");
    }
}
