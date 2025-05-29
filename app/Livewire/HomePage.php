<?php

namespace App\Livewire;

use App\Models\Event;
use App\Models\BlogPost;
use Livewire\Component;

class HomePage extends Component
{
    public $events;
    public $posts;

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
    }

    public function render()
    {
        
        return view('livewire.home-page');
    }
}
