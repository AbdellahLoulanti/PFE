<?php

namespace App\Livewire;

use App\Models\Job;
use Livewire\Component;

class JobPost extends Component
{
    public Job $job;

    public function mount(Job $job)
    {
        $this->job = $job;
    }

    public function render()
    {
        return view('livewire.job-post', [
            'job' => $this->job,
        ]);
    }
}
