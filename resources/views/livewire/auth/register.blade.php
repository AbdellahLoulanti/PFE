<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function register(): void
    {
        // Validation des champs (sans le champ "role")
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        // Ajout automatique du rôle "member"
        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'member';

        // Création de l'utilisateur
        $user = User::create($validated);

        // Déclenchement de l'événement d'inscription
        event(new Registered($user));

        // Connexion automatique
        Auth::login($user);

        // Redirection vers le tableau de bord "member"
        $this->redirectIntended(route('dashboard'), navigate: true);
    }
};
?>

<!-- HTML complet -->
<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Create an account')" :description="__('Register to follow the association')" />

    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="register" class="flex flex-col gap-6">
        <flux:input wire:model="name" :label="__('Name')" type="text" required autocomplete="name" placeholder="Full name" />
        <flux:input wire:model="email" :label="__('Email')" type="email" required autocomplete="email" placeholder="email@example.com" />
        <flux:input wire:model="password" :label="__('Password')" type="password" required autocomplete="new-password" placeholder="Password" />
        <flux:input wire:model="password_confirmation" :label="__('Confirm Password')" type="password" required autocomplete="new-password" placeholder="Confirm Password" />

        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full">
                {{ __('Register') }}
            </flux:button>
        </div>
    </form>

    <div class="space-x-1 text-center text-sm text-zinc-600 dark:text-zinc-400">
        {{ __('Already have an account?') }}
        <flux:link :href="route('login')" wire:navigate>{{ __('Log in') }}</flux:link>
    </div>
</div>
