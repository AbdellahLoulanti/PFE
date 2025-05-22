<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ContactMessage;


class ContactUs extends Component
{
    public $name;
    public $email;
    public $message;

    // ✅ Règles de validation
    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'message' => 'required|min:10',
    ];

    public function send()
    {
        // ✅ Valider les champs
        $this->validate();

        // ✅ Option : enregistrer en base
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
