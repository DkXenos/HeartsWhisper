<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\ModeratorRequestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage');
});

Route::get('/guides', function () {
    return view('guides');
})->name('guides');

// Forum routes
Route::get('/forums', [ForumController::class, 'index'])->name('forums.index');
Route::get('/forums/create', function () {
    $categories = \App\Models\Category::all();
    return view('forum.create', ['categories' => $categories]);
})->middleware('auth')->name('forums.create');
Route::post('/forums', [ForumController::class, 'store'])->middleware('auth')->name('forums.store');
Route::get('/forums/{id}', [ForumController::class, 'show'])->name('forums.show');
Route::get('/forums/{id}/edit', [ForumController::class, 'edit'])->middleware('auth')->name('forums.edit');
Route::put('/forums/{id}', [ForumController::class, 'update'])->middleware('auth')->name('forums.update');
Route::delete('/forums/{id}', [ForumController::class, 'destroy'])->middleware('auth')->name('forums.destroy');

// Reply routes
Route::post('/posts/{post}/replies', [ReplyController::class, 'store'])->middleware('auth')->name('replies.store');
Route::put('/replies/{reply}', [ReplyController::class, 'update'])->middleware('auth')->name('replies.update');
Route::delete('/replies/{reply}', [ReplyController::class, 'destroy'])->middleware('auth')->name('replies.destroy');

// Like routes
Route::post('/posts/{post}/like', [LikeController::class, 'likePost'])->middleware('auth')->name('posts.like');
Route::post('/replies/{reply}/like', [LikeController::class, 'likeReply'])->middleware('auth')->name('replies.like');

// Moderator Request routes
Route::get('/moderator/request', [ModeratorRequestController::class, 'create'])->middleware('auth')->name('moderator.request');
Route::post('/moderator/request', [ModeratorRequestController::class, 'store'])->middleware('auth')->name('moderator.store');

// Admin routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/moderator-requests', [ModeratorRequestController::class, 'index'])->name('admin.moderator-requests');
    Route::post('/admin/moderator-requests/{id}/approve', [ModeratorRequestController::class, 'approve'])->name('admin.moderator-requests.approve');
    Route::post('/admin/moderator-requests/{id}/reject', [ModeratorRequestController::class, 'reject'])->name('admin.moderator-requests.reject');
});

Route::get('/dashboard', function () {
    $user = auth()->user();
    $posts = \App\Models\Post::where('user_id', $user->id)
        ->withCount('replies')
        ->with(['user', 'categories'])
        ->latest()
        ->paginate(10);
    
    $repliesCount = \App\Models\Reply::where('user_id', $user->id)->count();
    
    // Total likes from user's posts
    $postLikes = \App\Models\Post::where('user_id', $user->id)->sum('likes_count');
    
    // Total likes from user's replies
    $replyLikes = \App\Models\Reply::where('user_id', $user->id)->sum('likes_count');
    
    $totalLikes = $postLikes + $replyLikes;
    
    return view('dashboard', [
        'posts' => $posts,
        'repliesCount' => $repliesCount,
        'totalLikes' => $totalLikes
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
