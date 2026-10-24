<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Show Blog Posts, Utsavs and News
     */
    public function index()
    {
        $posts = BlogPost::orderBy('published_date', 'desc')->paginate(6);

        return view('frontend.blog.index', compact('posts'));
    }

    /**
     * Show single blog post
     */
    public function show(string $slug)
    {
        $post = BlogPost::where('slug', $slug)->firstOrFail();
        $recentPosts = BlogPost::where('id', '!=', $post->id)->latest()->take(3)->get();

        return view('frontend.blog.show', compact('post', 'recentPosts'));
    }
}
