<?php

namespace App\Http\Livewire;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Demo extends Component
{
    public $email;

    public function render()
    {
        return view('livewire.demo');
    }

    public function sendDemoVideo()
    {
        Validator::make(
            [
                'email' => $this->email
            ], [
            'email' => ['required', 'email', 'string', 'max:255']
        ])->validateWithBag('sendDemoVideo');

        mailjet_send_email_by_template([
            'Email' => $this->email,
        ], 3791961, [

        ]);
        $this->reset('email');
        $this->emit('showToast', 'Success!', 'Demo video sent successfully at your email address.');
    }

    public function sendMeAnOfferForm()
    {
        Validator::make(
            [
                'email' => $this->email
            ], [
            'email' => ['required', 'email', 'string', 'max:255']
        ])->validateWithBag('sendDemoVideo');

        mailjet_send_email_by_template([
            'Email' => $this->email,
        ], 3792194, [

        ]);

        $this->reset('email');
        $this->emit('showToast', 'Success!', 'Email sent successfully at your email address.');
    }
}
