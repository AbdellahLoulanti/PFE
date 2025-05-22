<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Event;

class Events extends Component
{
    public $event;

    public function mount($id)
    {
        $this->event = Event::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.events', [
            'event' => $this->event,
        ]);
}

}
