<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;

class HomePage extends Component
{
    public $events;

    public function mount()
    {
        $this->events = Event::where('visibility', 'public')
            ->orderBy('start_date', 'asc')
            ->take(5)
            ->get();
    }

    public function render()
    {
        return view('livewire.home-page');
    }
}
