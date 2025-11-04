<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Response;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::published()->orderByDesc('date')->paginate(18);

        if ($request->ajax()) {
            return response()->json([
                'posts' => view('components.posts.list', ['posts' => $posts->items()])->render(),
                'next_page_url' => $posts->nextPageUrl(),
            ]);
        }

        return view('posts.index', ['posts' => $posts]);
    }

    public function show(Post $post): View
    {
        return view('posts.show', ['post' => $post]);
    }

    public function category(Request $request, PostCategory $postCategory)
    {
        $posts = $postCategory->posts()->orderByDesc('date')->paginate(18);

        if ($request->ajax()) {
            return response()->json([
                'posts' => view('components.posts.list', ['posts' => $posts->items()])->render(),
                'next_page_url' => $posts->nextPageUrl(),
            ]);
        }

        return view('posts.category', [
            'posts' => $posts,
            'postCategory' => $postCategory,
        ]);
    }
}
