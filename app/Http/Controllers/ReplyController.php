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
}
