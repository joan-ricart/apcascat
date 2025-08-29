<?php

namespace App\View\Components\Sidebar;

use App\Models\PostCategory;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Categories extends Component
{
    public $categories;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->categories = PostCategory::withCount('posts')->orderByDesc('posts_count')->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar.categories');
    }
}
