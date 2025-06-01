<?php

namespace App\Livewire;

use Livewire\Component;
use Stripe\Charge;
use Stripe\Stripe;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmed;

class PaymentForm extends Component
{
    public $name;
    public $email;
    public $amount;
    public $card_token;
    public $cart = [];
    public $successMessage;

    protected $listeners = ['setStripeToken'];
    

   public function mount()
{
    $orderData = session()->get('order_data');

    if (!$orderData) {
        logger('❌ Aucune donnée order_data trouvée dans la session');
    } else {
        logger('✅ Données session récupérées', $orderData);

        $this->amount = $orderData['total'];
        $this->email = $orderData['email'];
        $this->name = $orderData['name'];
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
        logger('⏳ Paiement en cours...');

        Charge::create([
            'amount' => $this->amount * 100,
            'currency' => 'eur',
            'description' => 'Paiement Livewire',
            'source' => $this->card_token,
            'receipt_email' => $this->email,
        ]);

        logger('✅ Paiement validé. Création de la commande...');

        $orderData = session()->get('order_data');

        if (!$orderData) {
            logger('❌ Données de session absentes');
            $this->addError('stripe', 'Impossible de retrouver les informations de commande.');
            return;
        }

        $order = \App\Models\Order::create([
            'name' => $orderData['name'],
            'email' => $orderData['email'],
            'phone' => $orderData['phone'],
            'address' => $orderData['address'],
            'city' => $orderData['city'],
            'postal_code' => $orderData['postal_code'],
            'items' => json_encode($orderData['cart']),
            'total' => $orderData['total'],
            'payment_method' => $orderData['payment_method'],
        ]);

        foreach ($orderData['cart'] as $item) {
            $order->items()->create([
                'product_id' => $item['id'],
                'quantity' => $item['quantity'] ?? 1,
                'price' => $item['price'],
            ]);

            $product = \App\Models\Product::find($item['id']);
            if ($product) {
                $product->stock = max(0, $product->stock - ($item['quantity'] ?? 1));
                $product->save();
            }
        }

        \Illuminate\Support\Facades\Mail::to('pfe002025@gmail.com')->send(new \App\Mail\OrderConfirmed($order));

        session()->forget(['cart', 'order_data']);

        logger('✅ COMMANDE créée avec succès : ID ' . $order->id);

        return redirect()->route('merci');

    } catch (\Exception $e) {
        logger('❌ Erreur de paiement Stripe : ' . $e->getMessage());
        $this->addError('stripe', $e->getMessage());
    }
}


    public function setStripeToken($data)
    {
        $this->card_token = $data['token'];
        $this->processPayment();
        $this->dispatchBrowserEvent('payment-success');
    }

    public function render()
    {
        return view('livewire.payment-form');
    }
}
