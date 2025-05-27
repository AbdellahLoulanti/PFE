<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class Products extends Component
{
    public function render()
    {
        $products = Product::where('stock', '>', 0)
            ->latest()
            ->get()
            ->groupBy('category');

        return view('livewire.products', compact('products'));
    }
}