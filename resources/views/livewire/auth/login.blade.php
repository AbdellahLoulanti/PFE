<div class="flex min-h-screen">
    <!-- Form section -->
    <div class="w-full md:w-1/2 flex flex-col justify-center items-center px-6 md:px-20 py-12">
        <div class="w-full max-w-md space-y-6">
          <img src="{{ asset('images/lg.jpg') }}" alt="login" class="w-36 mb-6">


            <h2 class="text-3xl font-bold text-gray-900">Login to Your Account</h2>


            <form wire:submit="login" class="space-y-4">
                <input type="email" wire:model="email" placeholder="Email" required
                    class="w-full px-4 py-3 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-teal-500" />

                <div class="relative">
                    <input type="password" wire:model="password" placeholder="Password" required
                        class="w-full px-4 py-3 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-teal-500" />
                </div>

                <div class="flex justify-between items-center text-sm text-gray-600">
                    <label>
                        <input type="checkbox" wire:model="remember" class="mr-1" />
                        Remember for 30 days
                    </label>
                    <a href="{{ route('password.request') }}" class="text-teal-600 hover:underline">Forgot password</a>
                </div>

                <button type="submit"
                    class="w-full bg-teal-500 hover:bg-teal-600 text-white py-3 rounded-full font-semibold">
                    Sign In
                </button>
            </form>

            <div class="text-center text-sm text-gray-600">
                Don’t have an account? <a href="{{ route('register') }}" class="text-teal-600 hover:underline">Sign up</a>
            </div>
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