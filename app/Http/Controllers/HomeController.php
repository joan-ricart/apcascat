<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function __invoke(Request $request)
    {
        $categories = PostCategory::all();
        $posts = Post::all();

        return view('home', compact('categories', 'posts'));
    }
}
