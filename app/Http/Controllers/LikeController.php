<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Reply;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LikeController extends Controller
{
    public function likePost(Post $post)
    {
        $user = auth()->user();
        
        // Check if already liked
        $existingLike = Like::where('user_id', $user->id)
            ->where('post_id', $post->id)
            ->first();

        if ($existingLike) {
            // Unlike
            $existingLike->delete();
            $post->decrement('likes_count');
            
            return response()->json([
                'liked' => false,
                'likes_count' => $post->fresh()->likes_count
            ]);
        } else {
            // Like
            Like::create([
                'user_id' => $user->id,
                'post_id' => $post->id,
            ]);
            $post->increment('likes_count');
            
            return response()->json([
                'liked' => true,
                'likes_count' => $post->fresh()->likes_count
            ]);
        }
    }

    public function likeReply(Reply $reply)
    {
        $user = auth()->user();
        
        // Check if already liked
        $existingLike = Like::where('user_id', $user->id)
            ->where('reply_id', $reply->id)
            ->first();

        if ($existingLike) {
            // Unlike
            $existingLike->delete();
            $reply->decrement('likes_count');
            
            return response()->json([
                'liked' => false,
                'likes_count' => $reply->fresh()->likes_count
            ]);
        } else {
            // Like
            Like::create([
                'user_id' => $user->id,
                'reply_id' => $reply->id,
            ]);
            $reply->increment('likes_count');
            
            return response()->json([
                'liked' => true,
                'likes_count' => $reply->fresh()->likes_count
            ]);
        }
    }
}
