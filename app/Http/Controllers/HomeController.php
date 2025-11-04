<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function __invoke(Request $request)
    {
        $posts = Post::published()->orderByDesc('date')->limit(9)->get();

        return view('home', compact('posts'));
    }
}
