<div class="bg-50">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <h2 class="sr-only">Checkout</h2>

    <form wire:submit.prevent="submitOrder" class="lg:grid lg:grid-cols-3 lg:gap-x-12 xl:gap-x-16">
      <div class="lg:col-span-2">
        <h2 class="text-2xl font-semibold text-teal-600 mb-6">Informations de livraison</h2>

        <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
          <div class="sm:col-span-2">
            <input wire:model.defer="name" type="text" placeholder="Nom complet" autocomplete="given-name"
              class="w-full px-4 py-3 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-teal-500" />
            @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
          </div>

          <div class="sm:col-span-2">
            <input wire:model.defer="address" type="text" placeholder="Adresse" autocomplete="street-address"
              class="w-full px-4 py-3 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-teal-500" />
            @error('address') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
          </div>

          <div>
            <input wire:model.defer="city" type="text" placeholder="Ville"
              class="w-full px-4 py-3 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-teal-500" />
            @error('city') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
          </div>

          <div>
            <input wire:model.defer="postal_code" type="text" placeholder="Code postal"
              class="w-full px-4 py-3 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-teal-500" />
            @error('postal_code') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
          </div>

          <div class="sm:col-span-2">
            <input wire:model.defer="phone" type="text" placeholder="Téléphone"
              class="w-full px-4 py-3 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-teal-500" />
            @error('phone') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
          </div>

          <div class="sm:col-span-2">
            <input wire:model.defer="email" type="email" placeholder="Email"
              class="w-full px-4 py-3 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-teal-500" />
            @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
          </div>
        </div>

        <div class="mt-10 border-t border-gray-200 pt-6">
          <h2 class="text-2xl font-semibold text-teal-600 mb-6">Méthode de paiement</h2>

          <fieldset>
            <legend class="sr-only">Type de paiement</legend>
            <div class="space-y-4 sm:flex sm:items-center sm:space-y-0 sm:space-x-10">

              <div class="flex items-center">
                <input wire:model.defer="payment" id="cash" name="payment" type="radio" value="cash"
                  class="h-4 w-4 border-gray-300 text-teal-600 focus:ring-teal-500">
                <label for="cash" class="ml-3 flex items-center text-sm font-medium text-gray-700">
                  <svg class="w-6 h-6 text-teal-600 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <path d="M3 10h18M3 14h18M4 6h16M4 18h16" />
                  </svg>
                  Paiement à la livraison
                </label>
              </div>

              <div class="flex items-center">
                <input wire:model.defer="payment" id="online" name="payment" type="radio" value="online"
                  class="h-4 w-4 border-gray-300 text-teal-600 focus:ring-teal-500">
                <label for="online" class="ml-3 flex items-center text-sm font-medium text-gray-700">
                  <svg class="w-6 h-6 text-teal-600 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <path d="M4 4h16v16H4z" />
                    <path d="M4 10h16" />
                    <path d="M10 4v16" />
                  </svg>
                  Paiement en ligne
                </label>
              </div>
            </div>
            @error('payment') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
          </fieldset>
        </div>
      </div>

      <div class="mt-10 lg:mt-0 fade-in-up">
        <h2 class="text-2xl font-semibold text-teal-700 mb-6">Résumé de la commande</h2>

        <div class="rounded-lg border border-gray-200 bg-white shadow-sm">
          <ul role="list" class="divide-y divide-gray-200">
            @forelse ($cart as $item)
              <li class="flex px-4 py-6 sm:px-6">
                <div class="h-20 w-20 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                  <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}"
                    class="h-full w-full object-cover object-center">
                </div>
                <div class="ml-6 flex flex-1 flex-col">
                  <div class="flex justify-between text-base font-medium text-gray-800">
                    <h3>{{ $item['name'] }}</h3>
                    <p class="ml-4">{{ number_format($item['price'], 2) }} DH</p>
                  </div>
                  <p class="mt-1 text-sm text-gray-600">Quantité : {{ $item['quantity'] }}</p>
                </div>
              </li>
            @empty
              <li class="p-4 text-center text-gray-500">Votre panier est vide.</li>
            @endforelse
          </ul>

          <div class="border-t border-gray-200 px-4 py-6 xl:px-6">
            <div class="flex justify-between text-base font-medium text-gray-900">
              <p>Total</p>
              <p>{{ number_format($total, 2) }} DH</p>
            </div>

            <div class="mt-6">
              <button type="submit"
    class="w-full rounded-full bg-teal-600 px-6 py-3 text-white font-semibold shadow hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 transition flex items-center justify-center"
    wire:loading.attr="disabled">

    <!-- Spinner visible pendant le chargement -->
    <svg wire:loading class="animate-spin h-5 w-5 mr-2 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
        viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor"
            d="M4 12a8 8 0 018-8v8H4z">
        </path>
    </svg>

    <span wire:loading.remove>Valider la commande</span>
    <span wire:loading>Traitement...</span>
</button>

            </div>

            @if (session()->has('success'))
              <div class="mt-4 text-teal-600 font-semibold">
                {{ session('success') }}
              </div>
            @elseif (session()->has('error'))
              <div class="mt-4 text-red-600 font-semibold">
                {{ session('error') }}
              </div>
            @endif
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
