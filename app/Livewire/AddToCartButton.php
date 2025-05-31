<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class AddToCartButton extends Component
{
    public $productId;

    public function addToCart()
    {
        $product = Product::findOrFail($this->productId);

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] = ($cart[$product->id]['quantity'] ?? 1) + 1;
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);
        $this->dispatch('cartUpdated');

        return redirect()->route('products');
    }

    public function render()
    {
        return view('livewire.add-to-cart-button');
    }
}
