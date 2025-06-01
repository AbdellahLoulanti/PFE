<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-6 text-teal-700">Paiement sécurisé</h2>
@if ($successMessage)
    <div class="mt-4 text-green-600 font-semibold">
        {{ $successMessage }}
    </div>
@endif

    <form id="payment-form" wire:submit.prevent="processPayment">
        <input type="text" wire:model="name" placeholder="Nom sur la carte" class="w-full mb-4 p-3 border rounded" />
        @error('name') <span class="text-red-500">{{ $message }}</span> @enderror

        <input type="email" wire:model="email" placeholder="Email" class="w-full mb-4 p-3 border rounded" />
        @error('email') <span class="text-red-500">{{ $message }}</span> @enderror

        <div id="card-element" class="p-4 bg-gray-100 rounded border"></div>
        <div id="card-errors" class="text-red-500 mt-2"></div>

       <button type="submit"
    class="mt-6 w-full bg-teal-600 text-white py-3 rounded hover:bg-teal-700 transition flex items-center justify-center"
    wire:loading.attr="disabled"
    wire:target="processPayment">

    <!-- Loader pendant le chargement -->
    <svg wire:loading wire:target="processPayment" class="animate-spin h-5 w-5 mr-2 text-white"
        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10"
            stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor"
            d="M4 12a8 8 0 018-8v8H4z">
        </path>
    </svg>

    <!-- Texte normal -->
    <span wire:loading.remove wire:target="processPayment">
        Payer {{ number_format($amount, 2) }} DH
    </span>

    <!-- Texte de chargement -->
    <span wire:loading wire:target="processPayment">
        Traitement...
    </span>
</button>

    </form>

</div>


<script src="https://js.stripe.com/v3/"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const stripe = Stripe("{{ env('STRIPE_KEY') }}");
        const elements = stripe.elements();
        const card = elements.create('card');
        card.mount('#card-element');

        const form = document.getElementById('payment-form');

        form.addEventListener('submit', async function (event) {
            event.preventDefault();

            const { token, error } = await stripe.createToken(card);

            if (error) {
                document.getElementById('card-errors').textContent = error.message;
            } else {
                Livewire.emit('setStripeToken', { token: token.id });
            }
        });

        Livewire.on('stripePaymentReady', () => {
            form.submit();
        });

        Livewire.on('paymentSuccess', () => {
            Livewire.restart();
        });
    });
</script>


