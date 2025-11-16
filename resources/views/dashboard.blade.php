@extends('layouts.app')

@section('title', 'Dashboard - Hearts Whisper')

@section('styles')
    @vite(['resources/css/forum.css', 'resources/css/navbar.css', 'resources/css/fonts.css'])
@endsection

@section('content')
    <img src="{{ asset('asset/forums/background-forum.svg') }}" alt="Dashboard Background"
        style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: -1;">

    <div class="forum-container">
        <!-- User Stats Header -->
        <div class="forum-header">
            <div>
                <h2>My Dashboard</h2>
                <p class="muted">Welcome back, {{ auth()->user()->username }}!</p>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="create-post-btn">Logout</button>
            </form>
        </div>

        <!-- Statistics Cards -->
        <div class="dashboard-stats">
            <div class="stat-card">
                <h3>{{ $posts->total() }}</h3>
                <p>Total Posts</p>
            </div>
            <div class="stat-card">
                <h3>{{ $repliesCount }}</h3>
                <p>Total Replies</p>
            </div>
            <div class="stat-card">
                <h3>{{ $totalLikes }}</h3>
                <p>Total Likes</p>
            </div>
        </div>

        <!-- User's Posts Section -->
        <div class="dashboard-section">
            <h3>My Posts</h3>
            @if($posts->count() > 0)
                <div class="posts-list">
                    @foreach ($posts as $post)
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
                                    <span>Posted {{ $post->created_at->diffForHumans() }}</span>
                                </div>

                                <div class="post-body post-clickable">
                                    <p>{{ Illuminate\Support\Str::limit($post->content, 300) }}</p>
                                </div>

                                @if ($post->categories->isNotEmpty())
                                    <div class="post-categories">
                                        @foreach ($post->categories as $category)
                                            <span class="category-badge">{{ $category->name }}</span>
                                        @endforeach
                                    </div>
                                @endif

                                <div class="post-footer">
                                    <span class="comment-count">
                                        {{ $post->replies_count ?? 0 }} replies
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="pagination-container">
                    {{ $posts->links() }}
                </div>
            @else
                <div class="empty-state">
                    <p>You haven't created any posts yet.</p>
                    <a href="{{ route('forums.create') }}" class="create-post-btn">Create Your First Post</a>
                </div>
            @endif
        </div>
    </div>
@endsection
