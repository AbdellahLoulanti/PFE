<?php

namespace App\Livewire;

use App\Models\Job;
use Livewire\Component;

class JobsList extends Component
{
    public function render()
    {
        $groupedJobs = Job::whereNotNull('published_at')
            ->orderByDesc('published_at')
            ->get()
            ->groupBy('type');

        return view('livewire.jobs-list', compact('groupedJobs'));
    }
}
