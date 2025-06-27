<?php
namespace App\Livewire;

use App\Mail\ContactMail;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Exception;

class ContactForm extends Component
{
    #[Validate('required|min:3|max:50')]
    public $name;

    #[Validate('required|email')]
    public $email;

    #[Validate('required|min:10|max:500')]
    public $message;

    public $showSuccessModal = false;
    public $showErrorModal = false;
    public $canSubmit = false;

    public function updated($propertyName)
    {
        $this->canSubmit = $this->getErrorBag()->isEmpty();
    }

    public function sendEmail()
    {
        try {
            $this->validate();

            Mail::to(new Address($this->email, $this->name))
                ->send(new ContactMail([
                    'fromName' => 'Earthify - Info',
                    'fromEmail' => 'info@earthify.com',
                    'subject' => 'Earthify - Contact Form',
                    'name' => $this->name,
                    'email' => $this->email,
                    'message' => $this->message,
                ]));

            $this->reset(['name', 'email', 'message']);
            $this->showSuccessModal = true;
            $this->canSubmit = false;
        } catch (Exception $e) {
            $this->showErrorModal = true;
        }
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
