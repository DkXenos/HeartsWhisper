<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
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
        $post = Post::with([
            'user',
            'categories',
            'replies' => function($query) {
                $query->whereNull('parent_id')
                      ->with(['user', 'replies.user', 'replies.replies.user'])
                      ->latest();
            }
        ])->findOrFail($id);

        return view('forum.show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified post.
     */
    public function edit($id)
    {
        $post = Post::with('categories')->findOrFail($id);
        
        // Check if user is the post owner
        if ($post->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $categories = Category::all();
        
        return view('forum.edit', [
            'post' => $post,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified post.
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        
        // Check if user is the post owner
        if ($post->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'content' => 'required|string|max:5000',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id'
        ]);

        $post->update([
            'content' => $request->content,
        ]);

        // Sync categories
        if ($request->has('categories')) {
            $post->categories()->sync($request->categories);
        } else {
            $post->categories()->detach();
        }

        return redirect()->route('forums.show', $post->id)->with('success', 'Post updated successfully!');
    }

    /**
     * Remove the specified post.
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        
        // Check if user is the post owner
        if ($post->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $post->delete();

        return redirect()->route('forums.index')->with('success', 'Post deleted successfully!');
    }
}