<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Event;

class EventsList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'tailwind';

    public function render()
    {
        return view('livewire.events-list', [
            'events' => Event::latest()->paginate(6),
        ]);
    }
}
