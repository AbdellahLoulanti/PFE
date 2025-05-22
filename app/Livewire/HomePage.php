<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Event;

class HomePage extends Component
{
    public $events;

    public function mount()
    {
        // Charger les 5 événements publics les plus proches
        $this->events = Event::where('visibility', 'public')
                             ->orderBy('start_date', 'asc')
                             ->take(5)
                             ->get();
    }

    public function render()
    {
        // Passer $this->events à la vue
        return view('livewire.home-page', [
            'events' => $this->events,
        ]);
    }
}
