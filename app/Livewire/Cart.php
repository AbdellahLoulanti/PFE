<?php

namespace App\Livewire;

use Livewire\Component;

class Cart extends Component
{
    public $cart = [];

    public $total = 0;

    protected $listeners = ['cartUpdated' => '$refresh'];

    public function mount()
    {
        $this->refreshCart();
    }

    public function render()
    {
        return view('livewire.cart', [
            'cart' => $this->cart,
            'total' => $this->total,
        ]);
    }

    public function increaseQuantity($productId)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += 1;
            session()->put('cart', $cart);
        }
        $this->refreshCart();
    }

    public function decreaseQuantity($productId)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$productId]) && $cart[$productId]['quantity'] > 1) {
            $cart[$productId]['quantity'] -= 1;
            session()->put('cart', $cart);
        }
        $this->refreshCart();
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        $this->refreshCart();
        session()->flash('success', 'Produit retiré du panier.');
    }

    private function refreshCart()
    {
        $this->cart = session()->get('cart', []);
        $this->total = collect($this->cart)->sum(function ($item) {
            return $item['price'] * ($item['quantity'] ?? 1);
        });
    }
}