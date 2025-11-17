@extends('layouts.app')

@section('title', 'Dashboard - Hearts Whisper')

@section('styles')
    @vite(['resources/css/forum.css', 'resources/css/navbar.css', 'resources/css/fonts.css'])
@endsection

@section('content')
    <img src="{{ asset('asset/forums/background-forum.svg') }}" alt="Dashboard Background"
        style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: -1;">

    <div class="forum-container">
        @if(session('success'))
            <div style="background: #4CAF50; color: white; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div style="background: #f44336; color: white; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                {{ session('error') }}
            </div>
        @endif
        @if(session('info'))
            <div style="background: #2196F3; color: white; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                {{ session('info') }}
            </div>
        @endif
        
        <!-- User Stats Header -->
        <div class="forum-header">
            <div>
                <h2>My Dashboard</h2>
                <p class="muted">Welcome back, {{ auth()->user()->username }}! 
                    @if(auth()->user()->role === 'moderator')
                        <span style="color: #4CAF50; font-weight: bold;">(Moderator)</span>
                    @elseif(auth()->user()->role === 'admin')
                        <span style="color: #FF5722; font-weight: bold;">(Admin)</span>
                    @endif
                </p>
            </div>
            <div style="display: flex; gap: 10px;">
                @if(auth()->user()->role === 'user')
                    @php
                        $pendingRequest = \App\Models\ModeratorRequest::where('user_id', auth()->id())
                            ->where('status', 'pending')
                            ->exists();
                    @endphp
                    @if(!$pendingRequest)
                        <a href="{{ route('moderator.request') }}" class="create-post-btn" style="background: #4CAF50;">Become a Moderator</a>
                    @else
                        <button class="create-post-btn" style="background: #999; cursor: not-allowed;" disabled>Request Pending</button>
                    @endif
                @endif
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.moderator-requests') }}" class="create-post-btn" style="background: #FF5722;">Moderator Requests</a>
                @endif
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="create-post-btn">Logout</button>
                </form>
            </div>
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
