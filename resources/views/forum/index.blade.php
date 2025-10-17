@extends('layouts.app')

@section('title', 'Forum - Hearts Whisper')

@section('content')
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
                <div class="post-card">
                    <!-- Vote Section -->
                    <div class="post-votes">
                        <button class="vote-btn upvote" aria-label="Upvote">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                            </svg>
                        </button>
                        <span class="vote-count">{{ $post->likes_count }}</span>
                        <button class="vote-btn downvote" aria-label="Downvote">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </div>

                    <!-- Content Section -->
                    <div class="post-content-container">
                        <div class="post-meta">
                            <span>Posted by 
                                <a href="#" class="post-author">{{ $post->user->username }}</a>
                            </span>
                            <span>&middot;</span>
                            <span>{{ $post->created_at->diffForHumans() }}</span>
                        </div>

                        <div class="post-body">
                            <p>{{ Illuminate\Support\Str::limit($post->content, 300) }}</p>
                        </div>

                        <div class="post-categories">
                            @foreach ($post->categories as $category)
                                <a href="#" class="category-tag">{{ $category->name }}</a>
                            @endforeach
                        </div>

                        <!-- Action Buttons -->
                        <div class="post-actions">
                            <button class="action-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                                Reply
                            </button>
                            <button class="action-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                                Like
                            </button>
                            <button class="action-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                </svg>
                                Share
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <p>No posts yet. Be the first to share your story!</p>
                </div>
            @endforelse
        </div>

        @if($posts->hasPages())
            <div class="pagination-container">
                <div class="pagination-info">
                    Showing {{ $posts->firstItem() }} to {{ $posts->lastItem() }} of {{ $posts->total() }} results
                </div>
                {{ $posts->links() }}
            </div>
        @endif
    </div>
@endsection