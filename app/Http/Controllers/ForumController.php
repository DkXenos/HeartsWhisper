<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    /**
     * Menampilkan halaman utama forum.
     */
    public function index()
    {
        // 1. Mengambil data dari database
        $posts = Post::with(['user', 'categories'])->latest()->paginate(15);

        // 2. Mengirim data '$posts' ke dalam view 'forums.index'
        return view('forum.index', [
            'posts' => $posts
        ]);
    }

    /**
     * Store a newly created post.
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:5000',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id'
        ]);

        $post = Post::create([
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        if ($request->has('categories')) {
            $post->categories()->attach($request->categories);
        }

        return redirect()->route('forums.index')->with('success', 'Post created successfully!');
    }

    /**
     * Display the specified post.
     */
    public function show($id)
    {
        $post = Post::with(['user', 'categories', 'replies.user'])->findOrFail($id);

        return view('forum.show', [
            'post' => $post
        ]);
    }
}