<?php

namespace App\Livewire;

use App\Models\ContactMessage;
use Livewire\Component;

class ContactUs extends Component
{
    public $name;

    public $email;

    public $message;

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'message' => 'required|min:10',
    ];

    public function send()
    {
        $this->validate();

        ContactMessage::create([
            'name' => $this->name,
            'email' => $this->email,
            'message' => $this->message,
        ]);

        $this->reset('name', 'email', 'message');

        session()->flash('success', 'Votre message a été envoyé avec succès.');
    }

    public function render()
    {
        return view('livewire.contact-us');
    }
}
