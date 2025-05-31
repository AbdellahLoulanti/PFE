<?php

namespace App\Livewire;

use Livewire\Component;

class CartIcon extends Component
{
    public $count = 0;

    protected $listeners = ['cartUpdated' => 'refreshCount'];

    public function mount()
    {
        $this->refreshCount();
    }

    public function refreshCount()
    {
        $cart = session()->get('cart', []);
        $this->count = collect($cart)->sum('quantity');
    }

    public function render()
    {
        return view('livewire.cart-icon');
    }
}
