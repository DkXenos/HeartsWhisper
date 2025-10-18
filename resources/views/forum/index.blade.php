@extends('layouts.app')

@section('title', 'Forum - Hearts Whisper')

@section('content')
    <img src="{{ asset('asset/forums/background-forum.svg') }}" alt="Homepage Background"
        style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: -1;">


    <div class="forum-container">
        <div class="forum-header">
            <div>
                <h2>Forum Discussions</h2>
                <p class="muted">Share your stories and connect with the community</p>
            </div>
            <a href="{{ route('forums.create') }}" class="create-post-btn">Create Post</a>
        </div>

        <div class="posts-list">
            @forelse ($posts as $post)
                <a href="{{ route('forums.show', $post->id) }}" class="post-card-link">
                    <div class="post-card">
                        <!-- Vote Section -->
                        <div class="post-votes">
                            @if(strtolower($post->user->gender) === 'female')
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

                            <div class="post-body">
                                <p>{{ Illuminate\Support\Str::limit($post->content, 300) }}</p>
                            </div>

                            <div class="post-categories">
                                @foreach ($post->categories as $category)
                                    <span class="category-tag">{{ $category->name }}</span>
                                @endforeach
                            </div>

                            <!-- Action Buttons -->
                            <div class="post-actions">
                                <div class="action-btn">
                                    <img src="{{ asset('asset/forums/replybutton.svg') }}" alt="reply" class="reply-icon">
                                    <span>{{ $post->replies->count() }} Replies</span>
                                </div>
                                <div class="action-btn">
                                    <img src="{{ asset('asset/forums/unliked.svg') }}" alt="like" class="like-icon">
                                    <span>{{ $post->likes_count }} Likes</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
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
