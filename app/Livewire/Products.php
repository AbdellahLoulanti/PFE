<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
        use WithPagination;

    protected $paginationTheme = 'tailwind';
    public function render()
    {
        $products = Product::where('stock', '>', 0)
            ->latest()
            ->paginate(5);
    $productsGrouped = $products->getCollection()->groupBy('category');

        return view('livewire.products', [
            'productsGrouped' => $productsGrouped,
            'products' => $products, 
        ]);
    }
}