<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;

class Events extends Component
{
    public $event;

    public function mount($id)
    {
        $this->event = Event::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.events');
    }
}
