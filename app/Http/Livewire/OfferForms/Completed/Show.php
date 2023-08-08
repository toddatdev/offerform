<?php

namespace App\Http\Livewire\OfferForms\Completed;

use App;
use App\Models\OfferForms\OfferForm;
use App\Models\OfferForms\OfferFormOffer;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Livewire\Component;

class Show extends Component
{
    public OfferFormOffer $offerFormOffer;
    public $isPdfMode = false;
    public $emailToExport;
    public $fieldsToExport = [];

    protected $listeners = [
        'onChangeSelection'
    ];

    public function mount()
    {
        $this->offerFormOffer->last_opened_at = now();
        $this->offerFormOffer->save();
        $this->offerFormOffer->fresh();

        if (request()->has('notify-ref')) {
            $notifyRef = request()->get('notify-ref', null);

            if ($notifyRef) {
                \DB::table('notifications')->where('id', $notifyRef)->delete();
            }
        }
    }

    public function exportToEmail()
    {
        $this->resetErrorBag();
        $this->validate([
            'emailToExport' => ['required', 'string', 'max:255', new App\Rules\CommaSeparatedEmails],
        ]);

        $emails = explode(',', str_replace(' ', '', $this->emailToExport));

        foreach ($emails as $email) {
            mailjet_send_email_by_template([
                'Email' => $email,
            ], 3935695, [
                'pdf_download_link' => URL::temporarySignedRoute(
                    'guest.completed.pdf',
                    Carbon::now()->addMonths(3),
                    [
                        'offerFormOffer' => $this->offerFormOffer->slug,
                        'fte' => implode(',', $this->fieldsToExport)
                    ]
                ),
                'agent_name' => $this->offerFormOffer->user->full_name,
                'agent_phone' => $this->offerFormOffer->user->phone,
                'agent_email' => $this->offerFormOffer->user->email
            ]);
//            Mail::raw('Hi, please find the pdf attached which have request few moments ago!', function ($message) use ($email) {
//                $message
//                    ->to($email)
//                    ->subject('Completed OfferFrom PDF')
//                    ->attachData($this->offerFormOffer->toPdf()->output(), "{$this->offerFormOffer->slug}.pdf");
//            });
        }

        $this->reset('emailToExport');
        $this->emit('hideModal');
        $this->emit('showToast', 'Success!', 'PDF generated successfully and sent at your email address.');
    }

    public function exportToZapier()
    {
        $this->emit('export-to-zapier');
    }

    public function onChangeSelection($fieldsToExport)
    {
        $this->fieldsToExport = $fieldsToExport;
    }

    public function render()
    {
        $view = view('livewire.offer-forms.completed.show');

        if ($this->isPdfMode) {
            return $view->layout('layouts.pdf');
        }

        return $view;
    }
}
