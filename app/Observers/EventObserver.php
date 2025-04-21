<?php

namespace App\Observers;

use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class EventObserver
{
    public function creating(Event $event)
    {
        $event->created_by = Auth::id();
    }
}
