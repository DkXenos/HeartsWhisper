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
}
