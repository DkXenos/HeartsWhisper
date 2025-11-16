@extends('layouts.app')

@section('title', 'Forum - Hearts Whisper')

@section('styles')
    @vite(['resources/css/forum.css', 'resources/css/navbar.css', 'resources/css/fonts.css'])
@endsection

@section('content')
    <img src="{{ asset('asset/forums/background-forum.svg') }}" alt="Homepage Background"
        style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: -1;">


    <div class="forum-container">
        <img src="asset/homepage/pillar-left.svg" alt="" class="pillar-left">
        <img src="asset/homepage/pillar-right.svg" alt="" class="pillar-right">

        <div class="forum-header">
            <div>
                <h2>Forum Discussions</h2>
                <p class="muted">Share your stories and connect with the community</p>
            </div>
            <a href="{{ route('forums.create') }}" class="create-post-btn">Create Post</a>
        </div>

        <div class="posts-list">
            @forelse ($posts as $post)
                <div class="post-card" data-post-url="{{ route('forums.show', $post->id) }}">
                    <!-- Vote Section -->
                    <div class="post-votes">
                        @if (strtolower($post->user->gender) === 'female')
                            <img src="{{ asset('asset/forums/girl.svg') }}" alt="Female Avatar" class="user-avatar">
                        @else
                            <img src="{{ asset('asset/forums/boi.svg') }}" alt="Male Avatar" class="user-avatar">
                        @endif
                        <span class="vote-count">{{ $post->likes_count }}</span>
                    </div>

                    <!-- Content Section -->
                    <div class="post-content-container">
                        <div class="post-meta">
                            <span>Posted by
                                <span class="post-author">{{ $post->user->username }}</span>
                            </span>
                            <span>&middot;</span>
                            <span>{{ $post->created_at->diffForHumans() }}</span>
                        </div>

                        <div class="post-body post-clickable">
                            <p>{{ Illuminate\Support\Str::limit($post->content, 300) }}</p>
                        </div>

                        <div class="post-categories">
                            @foreach ($post->categories as $category)
                                <span class="category-tag">{{ $category->name }}</span>
                            @endforeach
                        </div>

                        <!-- Action Buttons -->
                        <div class="post-actions">
                            <button class="action-btn reply-toggle-btn" data-post-id="{{ $post->id }}"
                                onclick="event.stopPropagation()">
                                <img src="{{ asset('asset/forums/replybutton.svg') }}" alt="reply" class="reply-icon">
                                Reply
                            </button>
                            @auth
                                <button class="action-btn like-toggle-btn" data-post-id="{{ $post->id }}"
                                    data-liked="{{ $post->isLikedBy(auth()->user()) ? 'true' : 'false' }}" 
                                    onclick="toggleLike(event, {{ $post->id }}, 'post')">
                                    <img src="{{ asset($post->isLikedBy(auth()->user()) ? 'asset/forums/liked.svg' : 'asset/forums/unliked.svg') }}" 
                                         alt="like" class="like-icon">
                                    <span class="like-text">{{ $post->isLikedBy(auth()->user()) ? 'Liked' : 'Like' }}</span>
                                </button>
                            @else
                                <a href="{{ route('login') }}" class="action-btn">
                                    <img src="{{ asset('asset/forums/unliked.svg') }}" alt="like" class="like-icon">
                                    Like
                                </a>
                            @endauth
                        </div>

                        <!-- Reply Section (Hidden by default) -->
                        <div class="reply-section" id="reply-section-{{ $post->id }}" style="display: none;"
                            onclick="event.stopPropagation()">
                            <form class="reply-form" data-post-id="{{ $post->id }}">
                                @csrf
                                <textarea class="reply-textarea" placeholder="Write your reply..." rows="3" maxlength="1000" required></textarea>
                                <div class="reply-actions">
                                    <span class="reply-char-count">
                                        <span class="current">0</span> / 1000
                                    </span>
                                    <div class="reply-buttons">
                                        <button type="button" class="reply-cancel-btn" data-post-id="{{ $post->id }}">
                                            Cancel
                                        </button>
                                        <button type="submit" class="reply-submit-btn">
                                            Post Reply
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <p>No posts yet. Be the first to share your story!</p>
                </div>
            @endforelse
        </div>

        @if ($posts->hasPages())
            <div class="pagination-container">
                <div class="pagination-info">
                    Showing {{ $posts->firstItem() }} to {{ $posts->lastItem() }} of {{ $posts->total() }} results
                </div>
                {{ $posts->links() }}
            </div>
        @endif
    </div>
@endsection
