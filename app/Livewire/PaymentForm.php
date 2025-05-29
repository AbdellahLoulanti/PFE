<?php

namespace App\Livewire;

use Livewire\Component;
use Stripe\Charge;
use Stripe\Stripe;

class PaymentForm extends Component
{
    public $name;

    public $email;

    public $amount;

    public $card_token;

    public $cart = [];

    public $successMessage;

    public function mount()
    {
        $orderId = session()->get('order_id');
        $order = \App\Models\Order::find($orderId);

        if ($order) {
            $this->amount = $order->total;
            $this->email = $order->email;
        } else {
            $this->amount = 0;
        }
    }

    public function processPayment()
    {
        $this->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'amount' => 'required|numeric|min:1',
            'card_token' => 'required|string',
        ]);

        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            Charge::create([
                'amount' => $this->amount * 100,
                'currency' => 'eur',
                'description' => 'Paiement Livewire',
                'source' => $this->card_token,
                'receipt_email' => $this->email,
            ]);

            $this->reset(['card_token']);
            $this->successMessage = 'Paiement réussi !';

            session()->forget('cart');
            $this->successMessage = 'Paiement réussi !';

        } catch (\Exception $e) {
            $this->addError('stripe', $e->getMessage());
        }
        
    }

    public function render()
    {
        return view('livewire.payment-form');
    }
}