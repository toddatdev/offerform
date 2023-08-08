<?php

namespace App\Http\Livewire\Contact;

use App\Models\Inquiry;
use Livewire\Component;

class Form extends Component
{
    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $message;
    public $hear_about_us;

    protected $rules = [
        'first_name' => 'required|string|max:100',
        'last_name' => 'required|string|max:100',
        'email' => 'required|email|string|max:255',
//        'phone' => 'required|string|max:25',
        'message' => 'required|string|max:2000',
        'hear_about_us' => 'required|string|max:255',
    ];

    public function render()
    {
        return view('livewire.contact.form');
    }

    public function submit()
    {
        $this->validate();

        // Execution doesn't reach here if validation fails.

        Inquiry::create([
           'fname' => $this->first_name,
           'lname' => $this->last_name,
           'email' => $this->email,
           'phone' => $this->phone,
           'message' => $this->message,
           'hear_about_us' => $this->hear_about_us,
        ]);

        $this->reset();

        session()->flash('status', 'We received your query successfully. One of our team member will get back to you as soon as possible.');
    }
}
