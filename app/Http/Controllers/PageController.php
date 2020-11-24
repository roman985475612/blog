<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PageController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(5);
        return view('pages.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::where(['slug' => $slug])->firstOrFail();

        $prevPost = Post::find($post->hasPrevious());
        $nextPost = Post::find($post->hasNext());

        return view('pages.show', compact('post', 'prevPost', 'nextPost'));
    }
}
