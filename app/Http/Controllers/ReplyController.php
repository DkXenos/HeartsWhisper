<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Reply;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:replies,id'
        ]);

        $reply = Reply::create([
            'user_id' => auth()->id(),
            'post_id' => $post->id,
            'parent_id' => $request->parent_id,
            'content' => $request->content,
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Reply posted successfully!',
                'reply' => $reply->load('user')
            ]);
        }

        return redirect()->route('forums.show', $post->id)
            ->with('success', 'Reply posted successfully!');
    }

    public function update(Request $request, Reply $reply)
    {
        // Check if user is the reply owner
        if ($reply->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'content' => 'required|string|max:1000'
        ]);

        $reply->update([
            'content' => $request->content,
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Reply updated successfully!',
                'reply' => $reply
            ]);
        }

        return redirect()->route('forums.show', $reply->post_id)
            ->with('success', 'Reply updated successfully!');
    }

    public function destroy(Reply $reply)
    {
        $user = auth()->user();
        
        // Check if user is the reply owner, moderator, or admin
        if ($reply->user_id !== $user->id && !in_array($user->role, ['moderator', 'admin'])) {
            abort(403, 'Unauthorized action.');
        }

        $postId = $reply->post_id;
        $reply->delete();

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Reply deleted successfully!'
            ]);
        }

        return redirect()->route('forums.show', $postId)
            ->with('success', 'Reply deleted successfully!');
    }
}
