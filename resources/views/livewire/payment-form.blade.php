<div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto p-6 bg-white rounded-lg shadow-lg">
    <!-- Résumé à gauche -->
    <div>
        <h2 class="text-xl font-semibold text-teal-800 mb-4">Votre commande</h2>
        <ul class="space-y-4">
            @php
    $cart = session()->get('cart', []);
@endphp

            @foreach ($cart as $item)
                <li class="flex justify-between border-b pb-2">
                    <span>{{ $item['name'] }} x {{ $item['quantity'] ?? 1 }}</span>
                    <span>{{ number_format($item['price'] * ($item['quantity'] ?? 1), 2) }} DH</span>
                </li>
            @endforeach
        </ul>
        <div class="mt-6 border-t pt-4 text-lg font-semibold text-teal-800 flex justify-between">
            <span>Total</span>
            <span>{{ number_format($amount, 2) }} DH</span>
        </div>
    </div>

    <!-- Paiement à droite -->
    <div>
    <h2 class="text-xl font-semibold text-teal-800 mb-4">Payer avec carte</h2>

    @if($successMessage)
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ $successMessage }}</div>
    @endif

    @error('stripe')
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">{{ $message }}</div>
    @enderror

    <form wire:submit.prevent="processPayment" id="payment-form" class="space-y-4">
        <!-- Email -->
        <div>
            <label class="block text-sm text-gray-600 mb-1">Email</label>
            <input type="email" wire:model="email" placeholder="exemple@domaine.com" class="w-full px-4 py-3 rounded border border-gray-300 focus:ring-teal-500 focus:outline-none" required>
        </div>

        <!-- Carte bancaire -->
        <div>
            <label class="block text-sm text-gray-600 mb-1">Numéro de carte</label>
            <div class="relative">
                <div id="card-element" class="px-4 py-3 border border-gray-300 rounded bg-gray-50"></div>

                <!-- Icônes des cartes -->
                <div class="absolute top-1/2 transform -translate-y-1/2 right-4 flex gap-1">
                    <img src="https://img.icons8.com/color/24/000000/visa.png" alt="Visa" />
                    <img src="https://img.icons8.com/color/24/000000/mastercard.png" alt="Mastercard" />
                    <img src="https://img.icons8.com/color/24/000000/amex.png" alt="Amex" />
                </div>
            </div>
        </div>

        <!-- Nom sur la carte -->
        <div>
            <label class="block text-sm text-gray-600 mb-1">Nom sur la carte</label>
            <input type="text" wire:model="name" placeholder="Nom Prénom" class="w-full px-4 py-3 rounded border border-gray-300 focus:ring-teal-500 focus:outline-none" required>
        </div>
       

        <!-- Champ caché pour token -->
        <input type="hidden" id="card_token" wire:model="card_token">

        <!-- Bouton de paiement -->
        <button type="submit" class="w-full px-4 py-3 bg-teal-600 text-white rounded font-semibold hover:bg-teal-700 transition">
            Payer
        </button>
    </form>

    <!-- Script Stripe -->
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe("{{ env('STRIPE_KEY') }}");
        const elements = stripe.elements();
        const card = elements.create('card');
        card.mount('#card-element');

        const form = document.getElementById('payment-form');

        form.addEventListener('submit', async function (e) {
            e.preventDefault();
            const result = await stripe.createToken(card);

            if (result.error) {
                alert(result.error.message);
            } else {
                @this.set('card_token', result.token.id).then(() => {
                    form.submit();
                });
            }
        });
    </script>
</div>