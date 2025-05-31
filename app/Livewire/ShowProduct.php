<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class ShowProduct extends Component
{
    public $product;

    public function mount($productId)
    {
        $this->product = Product::find($productId);

        if (! $this->product) {
            abort(404, 'Produit non trouvé.');
        }
    }

    public function addToCart()
    {
        // Exemple simple d'ajout au panier via session
        $cart = session()->get('cart', []);
        $productId = $this->product->id;

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                'name' => $this->product->name,
                'price' => $this->product->price,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);

        $this->dispatch('cartUpdated');

        return redirect()->route('products')->with('success', 'Produit ajouté au panier.');
    }

    public function render()
    {
        return view('livewire.show-product');
    }
}
