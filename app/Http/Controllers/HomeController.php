<?php

namespace App\Http\Controllers;

use App\Models\PostCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function __invoke(Request $request)
    {
        $categories = PostCategory::all();
        $posts = PostCategory::all();

        return view('home', compact('categories', 'posts'));
    }
}
