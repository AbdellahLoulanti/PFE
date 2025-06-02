<div class="text-center py-20">
    <h2 class="text-2xl font-bold mb-6">Redirection vers Stripe...</h2>
    <p class="mb-4">Veuillez patienter...</p>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe(@json($stripeKey));
        stripe.redirectToCheckout({
            sessionId: @json($checkoutSessionId)
        }).then(function (result) {
            console.error(result.error.message);
        });
    </script>
</div>
