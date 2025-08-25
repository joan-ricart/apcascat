<?php

namespace App\View\Components\Sidebar;

use Illuminate\View\View;
use Illuminate\View\Component;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Post;

class RecentPosts extends Component
{
    public Collection $posts;

    /**
     * Create a new component instance.
     */
    public function __construct(int $limit = 6)
    {
        $this->posts = Post::orderByDesc('date')->take($limit)->get();
    }

    public function render(): View
    {
        return view('components.sidebar.recent-posts');
    }
}
