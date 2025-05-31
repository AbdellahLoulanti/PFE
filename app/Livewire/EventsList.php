<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;

class EventsList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public function render()
    {
        return view('livewire.events-list', [
            'events' => Event::public()->latest()->paginate(4),
        ]);
    }
}
