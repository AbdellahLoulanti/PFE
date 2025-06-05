<?php

namespace App\Livewire;

use Livewire\Component;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Stripe;

class PaymentForm extends Component
{
    public $checkoutSessionId;

    public function mount()
    {
        $orderData = session('order_data');
        if (! $orderData) {
            return redirect()->route('checkout');
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        $lineItems = [];
        foreach ($orderData['cart'] as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'mad',
                    'product_data' => [
                        'name' => $item['name'],
                    ],
                    'unit_amount' => $item['price'] * 100,
                ],
                'quantity' => $item['quantity'],
            ];
        }

        $session = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [$lineItems],
            'mode' => 'payment',
            'success_url' => route('payment.success', [], true).'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout'),
        ]);

        $this->checkoutSessionId = $session->id;
    }

    public function render()
    {
        return view('livewire.payment-form')->with([
            'stripeKey' => config('services.stripe.key'),
            'checkoutSessionId' => $this->checkoutSessionId,
        ]);
    }
}
