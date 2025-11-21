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
    public function index(Request $request)
    {
        $query = Post::with(['user', 'categories']);

        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where('content', 'like', '%' . $searchTerm . '%');
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->whereHas('categories', function($q) use ($request) {
                $q->where('categories.id', $request->category);
            });
        }

        // Sort by date
        if ($request->filled('sort')) {
            if ($request->sort === 'oldest') {
                $query->oldest();
            } else if ($request->sort === 'latest') {
                $query->latest();
            }
        } else {
            $query->latest(); // Default sort
        }

        $posts = $query->paginate(perPage: 10)->appends($request->except('page'));
        $categories = Category::all();

        return view('forum.index', [
            'posts' => $posts,
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created post.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:5000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        $post = Post::create([
            'user_id' => auth()->id(),
            'content' => $validated['content'],
            'image' => $imagePath,
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

        $validated = $request->validate([
            'content' => 'required|string|max:5000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id'
        ]);

        $updateData = [
            'content' => $validated['content'],
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($post->image) {
                \Storage::disk('public')->delete($post->image);
            }
            $updateData['image'] = $request->file('image')->store('posts', 'public');
        }

        // Handle image removal
        if ($request->has('remove_image') && $request->remove_image == '1') {
            if ($post->image) {
                \Storage::disk('public')->delete($post->image);
            }
            $updateData['image'] = null;
        }

        $post->update($updateData);

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
        
        $user = auth()->user();
        
        // Check if user is the post owner, moderator, or admin
        if ($post->user_id !== $user->id && !in_array($user->role, ['moderator', 'admin'])) {
            abort(403, 'Unauthorized action.');
        }

        // Delete image if exists
        if ($post->image) {
            \Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()->route('forums.index')->with('success', 'Post deleted successfully!');
    }
}