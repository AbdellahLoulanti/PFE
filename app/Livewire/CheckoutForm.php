<?php

namespace App\Livewire;

use App\Mail\OrderConfirmed;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class CheckoutForm extends Component
{
    public $name;

    public $email;

    public $phone;

    public $address;

    public $city;

    public $postal_code;

    public $payment;

    public $cart = [];

    public $total = 0;

    public $items = [];

    protected $rules = [
        'name' => 'required|string|min:3',
        'email' => 'required|email',
        'phone' => 'required|string|min:6',
        'address' => 'required|string|min:5',
        'city' => 'required|string',
        'postal_code' => 'required|string',
        'payment' => 'required|in:cash,online',
    ];

    public function mount()
    {
        $this->cart = session()->get('cart', []);
        $this->total = array_sum(array_map(function ($item) {
            return $item['price'] * ($item['quantity'] ?? 1);
        }, $this->cart));
    }

    public function submitOrder()
    {
        if (empty($this->cart)) {
            session()->flash('error', 'Votre panier est vide.');

            return;
        }

        $this->validate();

        $order = Order::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'city' => $this->city,
            'postal_code' => $this->postal_code,
            'items' => json_encode($this->cart),
            'total' => $this->total,
            'payment_method' => $this->payment,
        ]);

        foreach ($this->cart as $item) {
            $order->items()->create([
                'product_id' => $item['id'],
                'quantity' => $item['quantity'] ?? 1,
                'price' => $item['price'],
            ]);

            // Mise à jour du stock
            $product = Product::find($item['id']);
            if ($product) {
                $product->stock = max(0, $product->stock - ($item['quantity'] ?? 1));
                $product->save();
            }
        }
        $order->load('items.product');

        Mail::to('pfe002025@gmail.com')->send(new OrderConfirmed($order));

        // Nettoyer le panier
        session()->forget('cart');

        if ($this->payment === 'cash') {
            session()->flash('success', 'Commande validée avec succès ! Paiement à la livraison.');
            session()->forget('cart');

            return redirect()->route('products');
        } elseif ($this->payment === 'online') {
            session()->put('order_id', $order->id);

            return redirect()->route('paiement');
        } else {
            session()->flash('error', 'Veuillez sélectionner une méthode de paiement valide.');
        }
    }

    public function render()
    {
        $cart = session()->get('cart', []);
        $subtotal = collect($cart)->sum(function ($item) {
            return $item['price'] * ($item['quantity'] ?? 1);
        });

        return view('livewire.checkout-form', [
            'cart' => $cart,
            'subtotal' => $subtotal,
            'total' => $this->total,
        ]);
    }
}
