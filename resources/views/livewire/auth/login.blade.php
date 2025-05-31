<?php

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    public function login(): void
    {
        $this->validate();

        $this->ensureIsNotRateLimited();

        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();
            if (auth()->user()->canAccessPanel(\Filament\Facades\Filament::getCurrentPanel())) {
    $this->redirect(route('filament.admin.pages.dashboard'), navigate: true);
} elseif (session()->has('cart') && count(session('cart')) > 0) {
    $this->redirect(route('checkout'), navigate: true); // Vers la page de commande si panier actif
} else {
    $this->redirect(route('home'), navigate: true);
}
}

    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email) . '|' . request()->ip());
    }
};
?>

<!-- Blade View -->
<div class="flex min-h-screen">
    <!-- Left: Login Form -->
    <div class="w-full md:w-1/2 flex flex-col justify-center items-center px-6 md:px-20 py-12 bg-white">
        <div class="w-full max-w-md space-y-6">

            <!-- Logo -->
            <div class="flex justify-center">
                <img src="{{ asset('images/lg.jpg') }}" alt="Logo" class="w-16 mb-4">
            </div>

            <!-- Heading -->
            <h2 class="text-3xl font-bold text-center text-gray-900">Log in to Your Account</h2>
            <p class="text-center text-gray-500 text-sm">Enter your details to access your account</p>

            <!-- Session Status -->
            <x-auth-session-status class="text-center" :status="session('status')" />

            <!-- Login Form -->
            <form wire:submit="login" class="space-y-4">
                <!-- Email -->
                <input type="email" wire:model="email" placeholder="Email" required
                       class="w-full px-4 py-3 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-teal-500">
                @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror

                <!-- Password -->
                <input type="password" wire:model="password" placeholder="Password" required
                       class="w-full px-4 py-3 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-teal-500">
                @error('password') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror

                <!-- Remember Me and Forgot -->
                <div class="flex justify-between items-center text-sm text-gray-600">
                    <label class="flex items-center gap-1">
                        <input type="checkbox" wire:model="remember" class="text-teal-500">
                        Remember me
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-teal-600 hover:underline">Forgot password?</a>
                    @endif
                </div>

<button type="submit"
        class="w-full bg-teal-500 hover:bg-teal-600 text-white py-3 rounded-full font-semibold transition flex items-center justify-center"
        wire:loading.attr="disabled">
    <svg wire:loading class="animate-spin h-5 w-5 mr-2 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
         viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10"
                stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor"
              d="M4 12a8 8 0 018-8v8z"></path>
    </svg>
    <span wire:loading.remove>Log In</span>
</button>

            </form>

            <!-- Register -->
            @if (Route::has('register'))
                <div class="text-center text-sm text-gray-600">
                    Don’t have an account?
                    <a href="{{ route('register') }}" class="text-teal-600 hover:underline">Create one</a>
                </div>
            @endif
        </div>
    </div>

    <!-- Right panel -->
     <div class="hidden md:flex md:w-1/2 bg-gradient-to-br from-teal-400 to-teal-600 text-white flex-col justify-center items-center px-8 relative">
        <h3 class="text-3xl font-bold mb-2">New Here?</h3>
        <p class="text-lg text-center max-w-sm mb-6">Sign up and discover a great amount of new opportunities!</p>
        <a href="{{ route('register') }}"
           class="bg-white text-teal-600 font-semibold px-6 py-2 rounded-full shadow hover:bg-gray-100 transition">
            Sign Up
        </a>
    </div>
</div>
