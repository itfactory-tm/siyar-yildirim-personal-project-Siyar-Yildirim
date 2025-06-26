<?php

namespace App\Livewire;

use App\Mail\ContactMail;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ContactForm extends Component
{
    #[Validate('required|min:3|max:50')]
    public $name = '';

    #[Validate('required|email')]
    public $email = '';

    #[Validate('required|min:10|max:500')]
    public $message = '';

    public $canSubmit = false;

    public function updated($property)
    {
        $this->validateOnly($property);
        $this->canSubmit = count($this->getErrorBag()) === 0;
    }

    public function sendEmail()
    {
        $validated = $this->validate();

        // Send email to Earthify
        Mail::to(new Address('info@earthifyshop.com', 'Earthify Contact'))
            ->send(new ContactMail($validated['name'], $validated['email'], $validated['message']));

        // Reset fields and show success
        $this->reset();
        session()->flash('success', 'Your message has been sent!');
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
