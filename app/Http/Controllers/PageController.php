<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;

class PageController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')->paginate(5);
        
        return view('pages.index', compact(
            'posts',
        ));
    }

    public function show($slug)
    {
        $post = Post::where(['slug' => $slug])->firstOrFail();

        $prevPost = Post::find($post->hasPrevious());
        $nextPost = Post::find($post->hasNext());

        return view('pages.show', compact('post', 'prevPost', 'nextPost'));
    }

    public function tag($slug)
    {
        $tag = Tag::where(['slug' => $slug])->firstOrFail();
        $posts = $tag->posts()->with('category')->paginate(4);
        
        return view('pages.list', compact('posts'));
    }

    public function category($slug)
    {
        $category = Category::where(['slug' => $slug])->firstOrFail();
        $posts = $category->posts()->with('category')->paginate(4);
        
        return view('pages.list', compact('posts'));
    }
}
