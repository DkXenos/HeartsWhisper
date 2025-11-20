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

        @if (session('success'))
            <div class="alert alert-success" style="background: #d1fae5; border: 2px solid #10b981; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem;">
                <p style="color: #065f46; margin: 0;">{{ session('success') }}</p>
            </div>
        @endif

        <div class="forum-header">
            <div>
                <h2>Forum Discussions</h2>
                <p class="muted">Share your stories and connect with the community</p>
            </div>
            <a href="{{ route('forums.create') }}" class="create-post-btn">Create Post</a>
        </div>

        <!-- Search and Filter Section -->
        <div class="search-filter-container">
            <form method="GET" action="{{ route('forums.index') }}" class="search-filter-form">
                <!-- Search Bar -->
                <div class="search-box">
                    <input type="text" 
                           name="search" 
                           placeholder="Search posts..." 
                           value="{{ request('search') }}"
                           class="search-input">
                    <button type="submit" class="search-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 20px; height: 20px;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </div>

                <!-- Filters -->
                <div class="filter-group">
                    <!-- Category Filter -->
                    <select name="category" class="filter-select" onchange="this.form.submit()">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Date Sort Filter -->
                    <select name="sort" class="filter-select" onchange="this.form.submit()">
                        <option value="latest" {{ request('sort') == 'latest' || !request('sort') ? 'selected' : '' }}>Latest First</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                    </select>

                    <!-- Clear Filters Button -->
                    @if(request('search') || request('category') || request('sort'))
                        <a href="{{ route('forums.index') }}" class="clear-filters-btn">Clear Filters</a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Results Info -->
        @if(request('search') || request('category') || request('sort'))
            <div class="results-info">
                <p>
                    Showing {{ $posts->total() }} result(s)
                    @if(request('search'))
                        for "<strong>{{ request('search') }}</strong>"
                    @endif
                    @if(request('category'))
                        in <strong>{{ $categories->find(request('category'))->name ?? 'selected category' }}</strong>
                    @endif
                </p>
            </div>
        @endif

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

                        @if($post->image)
                            <div class="post-image-container">
                                <img src="{{ asset('storage/' . $post->image) }}" alt="Post image" class="post-image">
                            </div>
                        @endif

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
                                    <span class="like-count">({{ $post->likes_count }})</span>
                                </button>
                            @else
                                <a href="{{ route('login') }}" class="action-btn">
                                    <img src="{{ asset('asset/forums/unliked.svg') }}" alt="like" class="like-icon">
                                    Like ({{ $post->likes_count }})
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

    <style>
        .post-image-container {
            margin: 1rem 0;
            border-radius: 15px;
            overflow: hidden;
            max-width: 100%;
        }

        .post-image {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            display: block;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .post-image:hover {
            transform: scale(1.02);
        }
    </style>
@endsection
