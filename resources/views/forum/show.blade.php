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
                </div>
            </div>
        </div>

        <!-- Reply Form -->
        <div class="reply-form-container">
            <h3>Leave a Reply</h3>
            <form class="main-reply-form" data-post-id="{{ $post->id }}">
                @csrf
                <textarea class="reply-textarea" placeholder="Share your thoughts..." rows="4" maxlength="1000" required></textarea>
                <div class="reply-actions">
                    <span class="reply-char-count">
                        <span class="current">0</span> / 1000
                    </span>
                    <button type="submit" class="reply-submit-btn">Post Reply</button>
                </div>
            </form>
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
