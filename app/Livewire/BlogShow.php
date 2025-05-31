<?php

namespace App\Livewire;

use App\Models\BlogPost;
use Livewire\Component;

class BlogShow extends Component
{
    public $post;

    public function mount($slug)
    {
        $this->post = BlogPost::with('user')
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.blog-show');
    }
}
