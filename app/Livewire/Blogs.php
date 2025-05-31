<?php

namespace App\Livewire;

use App\Models\BlogPost;
use Livewire\Component;
use Livewire\WithPagination;

class Blogs extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public function render()
    {
        $posts = BlogPost::with('user')
            ->where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        return view('livewire.blogs', [
            'posts' => $posts,
        ]);
    }
}
