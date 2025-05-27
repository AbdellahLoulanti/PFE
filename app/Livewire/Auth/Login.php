<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public string $email = '';

    public string $password = '';

    public bool $remember = false;

    public function login()
    {
        $credentials = $this->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $this->remember)) {
            session()->regenerate();

            return redirect()->intended('checkout');
        }

        $this->addError('email', 'Identifiants invalides.');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}