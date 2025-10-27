<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Post;

class Routing extends Controller
{
    public function showGuides()
    {
        return view('guides');
    }

    public function showForums()
    {
        $posts = Post::with(['user', 'categories'])->latest()->paginate(15);

        return view('forum.index', ['posts' => $posts]);
    }

    public function showCreatePost()
    {
        $categories = Category::all();

        return view('forum.create', ['categories' => $categories]);
    }

    public function showPost(Post $post)
    {
        $post->load(['user', 'categories', 'replies.user', 'replies.replies.user']);

        return view('forum.show', ['post' => $post]);
    }
}
