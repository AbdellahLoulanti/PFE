<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-green-100 via-blue-100 to-purple-100 px-4 py-6 -mt-[80px]">
    <div class="bg-white/80 backdrop-blur-lg shadow-2xl rounded-2xl p-10 w-full max-w-xl border border-white/40 animate-fade-in">

      <h2 class="text-4xl font-extrabold text-center text-gray-800 mb-8 tracking-tight animate-fade-in-down">📬 Contactez-nous</h2>

      @if (session()->has('success'))
        <div class="mb-4 animate-fade-in">
          <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded text-sm">
            {{ session('success') }}
          </div>
        </div>
      @endif

      <form wire:submit.prevent="send" class="space-y-6">
        <!-- Nom -->
        <div class="relative animate-fade-in-left delay-[200ms]">
          <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">👤 Nom complet</label>
          <input wire:model="name" type="text" id="name"
            class="w-full border border-gray-300 rounded-xl px-5 py-3 pl-10 focus:ring-2 focus:ring-blue-400 focus:outline-none transition duration-300 shadow-sm focus:shadow-md"
            placeholder="Votre nom complet">
          <div class="absolute left-3 top-10 text-gray-400 pointer-events-none">👤</div>
          @error('name') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Email -->
        <div class="relative animate-fade-in-left delay-[400ms]">
          <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">📧 Adresse email</label>
          <input wire:model="email" type="email" id="email"
            class="w-full border border-gray-300 rounded-xl px-5 py-3 pl-10 focus:ring-2 focus:ring-blue-400 focus:outline-none transition duration-300 shadow-sm focus:shadow-md"
            placeholder="exemple@email.com">
          <div class="absolute left-3 top-10 text-gray-400 pointer-events-none">📧</div>
          @error('email') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Message -->
        <div class="animate-fade-in-left delay-[600ms]">
          <label for="message" class="block text-sm font-semibold text-gray-700 mb-1">💬 Message</label>
          <textarea wire:model="message" id="message" rows="4"
            class="w-full border border-gray-300 rounded-xl px-5 py-3 focus:ring-2 focus:ring-blue-400 focus:outline-none transition duration-300 resize-none shadow-sm focus:shadow-md"
            placeholder="Votre message..."></textarea>
          @error('message') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Bouton -->
        <div class="text-center pt-2 animate-fade-in-up delay-[800ms]">
          <button type="submit"
            class="relative bg-gradient-to-r from-green-500 via-blue-500 to-purple-500 hover:from-purple-500 hover:to-green-500 text-white px-8 py-3 rounded-xl font-bold shadow-lg hover:shadow-2xl transition-all duration-500 ease-in-out transform hover:scale-105 flex items-center justify-center gap-2 disabled:opacity-50"
            wire:loading.attr="disabled"
            wire:target="send">

            <!-- Spinner -->
            <svg wire:loading wire:target="send" class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
            </svg>

            <span>
              <span wire:loading.remove wire:target="send">Envoyer le message</span>
              <span wire:loading wire:target="send">Envoi...</span>
            </span>
          </button>
        </div>
      </form>
    </div>
  </div>
