<?php
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Volt\Component;
new #[Layout('components.layouts.auth')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);
        $validated['password'] = Hash::make($validated['password']);
        event(new Registered(($user = User::create($validated))));
        Auth::login($user);
        $this->redirectIntended(route('checkout', absolute: false), navigate: true);
    }
}; ?>

<div class="flex min-h-screen">

    <!-- Form section -->

    <div class="w-full flex flex-col justify-center items-center px-6  py-12">

        <div class="w-full max-w-md space-y-6">

            <img src="{{ asset('images/lg.jpg') }}" alt="register" class="w-36 mb-6 mx-auto">

            <h2 class="text-3xl font-bold text-gray-900 text-center">Create Your Account</h2>

            <p class="text-center text-gray-600 mb-6">Enter your details below to create your account</p>


            @if (session()->has('success'))

                <div class="bg-green-100 text-green-700 p-3 rounded mb-4 text-center">

                    {{ session('success') }}

                </div>

            @endif

            <form wire:submit.prevent="register" class="space-y-4" novalidate>

                <input

                    type="text" wire:model.lazy="name" placeholder="Name" required

                    class="w-full px-4 py-3 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-teal-500" />

                @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror




                <input

                    type="email" wire:model.lazy="email" placeholder="Email" required

                    class="w-full px-4 py-3 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-teal-500" />

                @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                <input

                    type="password" wire:model.lazy="password" placeholder="Password" required

                    class="w-full px-4 py-3 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-teal-500" />

                @error('password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror




                <input

                    type="password" wire:model.lazy="password_confirmation" placeholder="Confirm Password" required

                    class="w-full px-4 py-3 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-teal-500" />




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
    <span wire:loading.remove>Create Account</span>
</button>

            </form>




            <div class="text-center text-sm text-gray-600 mt-4">

                Already have an account? 

                <a href="{{ route('login') }}" class="text-teal-600 hover:underline">Log in</a>

            </div>

        </div>

    </div>


<!-- Right: Welcome Panel -->
<div class="hidden md:flex w-full  h-full min-h-screen bg-gradient-to-br from-teal-400 to-teal-600 text-white flex-col justify-center items-center px-8 relative">
    <h3 class="text-3xl font-bold mb-2">Welcome Back!</h3>
    <p class="text-lg text-center max-w-sm mb-6">
        If you already have an account, log in to continue discovering great opportunities.
    </p>
    <a href="{{ route('login') }}"
       class="bg-white text-teal-600 font-semibold px-6 py-2 rounded-full shadow hover:bg-gray-100 transition">
        Log In
    </a>
</div>


</div>