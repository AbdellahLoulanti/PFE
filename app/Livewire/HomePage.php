<?php

namespace App\Livewire;

use App\Models\BlogPost;
use App\Models\Event;
use App\Models\Product;
use Livewire\Component;

class HomePage extends Component
{
    public $events;
    public $posts;
    public $products;

    public function mount()
    {
        $this->events = Event::where('visibility', 'public')
            ->orderBy('start_date', 'asc')
            ->take(4)
            ->get();
        $this->posts = BlogPost::where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();
         $this->products = Product::where('stock', '>', 0)
         ->latest()
         ->take(6)->get();

    }

    public function render()
    {

        return view('livewire.home-page');
    }
}
