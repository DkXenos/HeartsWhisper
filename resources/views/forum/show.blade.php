@extends('layouts.app')

@section('title', 'Post Details - Hearts Whisper')

@section('styles')
    @vite(['resources/css/show.css', 'resources/css/navbar.css', 'resources/css/fonts.css'])
@endsection

@section('content')
    <img src="{{ asset('asset/forums/background-forum.svg') }}" alt="Homepage Background"
        style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: -1;">

    <div class="forum-container">
        <!-- Back Button -->
        <div class="detail-header">
            <a href="{{ route('forums.index') }}" class="back-btn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Forums
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success" style="background: #d1fae5; border: 2px solid #10b981; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem;">
                <p style="color: #065f46; margin: 0;">{{ session('success') }}</p>
            </div>
        @endif

        <!-- Main Post -->
        <div class="post-detail-card">
            <div class="post-detail-votes">
                @if(strtolower($post->user->gender) === 'female')
                    <img src="{{ asset('asset/forums/girl.svg') }}" alt="Female Avatar" class="user-avatar-large">
                @else
                    <img src="{{ asset('asset/forums/boi.svg') }}" alt="Male Avatar" class="user-avatar-large">
                @endif
                <span class="vote-count-large">{{ $post->likes_count }}</span>
            </div>

            <div class="post-detail-content">
                <div class="post-meta">
                    <span>Posted by
                        <span class="post-author">{{ $post->user->username }}</span>
                    </span>
                    <span>&middot;</span>
                    <span>{{ $post->created_at->diffForHumans() }}</span>
                </div>

                <div class="post-body-full">
                    <p>{{ $post->content }}</p>
                </div>

                <div class="post-categories">
                    @foreach ($post->categories as $category)
                        <span class="category-tag">{{ $category->name }}</span>
                    @endforeach
                </div>

                <div class="post-actions">
                    <button class="action-btn like-toggle-btn" data-post-id="{{ $post->id }}" data-liked="false">
                        <img src="{{ asset('asset/forums/unliked.svg') }}" alt="like" class="like-icon">
                        Like ({{ $post->likes_count }})
                    </button>
                    
                    @auth
                        @if($post->user_id === auth()->id())
                            <a href="{{ route('forums.edit', $post->id) }}" class="action-btn edit-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 20px; height: 20px;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit
                            </a>
                            <form action="{{ route('forums.destroy', $post->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this post? This action cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn delete-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 20px; height: 20px;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Delete
                                </button>
                            </form>
                        @endif
                    @endauth
                </div>
            </div>
        </div>

        <!-- Reply Form -->
        <div class="reply-form-container">
            <h3>Leave a Reply</h3>
            @auth
                <form class="main-reply-form" method="POST" action="{{ route('replies.store', $post->id) }}">
                    @csrf
                    <textarea name="content" class="reply-textarea" placeholder="Share your thoughts..." rows="4" maxlength="1000" required>{{ old('content') }}</textarea>
                    @error('content')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                    <div class="reply-actions">
                        <span class="reply-char-count">
                            <span class="current">0</span> / 1000
                        </span>
                        <button type="submit" class="reply-submit-btn">Post Reply</button>
                    </div>
                </form>
            @else
                <div class="login-prompt">
                    <p>You must be <a href="{{ route('login') }}">logged in</a> to reply.</p>
                </div>
            @endauth
        </div>

        <!-- Replies Section -->
        <div class="replies-container">
            <h3>Replies ({{ $post->replies->count() }})</h3>
            
            @forelse($post->replies as $reply)
                @include('forum.partials.reply', ['reply' => $reply, 'level' => 0])
            @empty
                <div class="empty-replies">
                    <p>No replies yet. Be the first to reply!</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
