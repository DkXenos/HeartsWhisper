@extends('layouts.app')

@section('title', 'Moderator Requests - Admin Panel')

@section('styles')
    @vite(['resources/css/forum.css', 'resources/css/navbar.css', 'resources/css/fonts.css'])
@endsection

@section('content')
    <img src="{{ asset('asset/forums/background-forum.svg') }}" alt="Admin Background"
        style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: -1;">

    <div class="forum-container">
        <div class="forum-header">
            <div>
                <h2>Moderator Requests</h2>
                <p class="muted">Review and manage moderator applications</p>
            </div>
            <a href="{{ route('dashboard') }}" class="create-post-btn">Back to Dashboard</a>
        </div>

        @if(session('success'))
            <div style="background: #4CAF50; color: white; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        @if($requests->count() > 0)
            <div class="posts-list">
                @foreach($requests as $request)
                    <div class="post-card" style="cursor: default;">
                        <div class="post-votes">
                            @if(strtolower($request->user->gender) === 'female')
                                <img src="{{ asset('asset/forums/girl.svg') }}" alt="Female Avatar" class="user-avatar">
                            @else
                                <img src="{{ asset('asset/forums/boi.svg') }}" alt="Male Avatar" class="user-avatar">
                            @endif
                            <span class="vote-count">{{ $request->user->posts->count() }}</span>
                        </div>

                        <div class="post-content-container">
                            <div class="post-meta">
                                <span style="font-weight: bold;">{{ $request->user->username }}</span>
                                <span>&middot;</span>
                                <span>{{ $request->user->email }}</span>
                                <span>&middot;</span>
                                <span>Requested {{ $request->created_at->diffForHumans() }}</span>
                            </div>

                            <div style="margin: 15px 0;">
                                <p style="color: #666; margin-bottom: 10px;">
                                    <strong>User Stats:</strong><br>
                                    Posts: {{ $request->user->posts->count() }} | 
                                    Replies: {{ $request->user->likes->where('reply_id', '!=', null)->count() }} | 
                                    Account Age: {{ $request->user->created_at->diffForHumans() }}
                                </p>
                                @if($request->reason)
                                    <p style="margin-top: 15px;">
                                        <strong>Reason:</strong><br>
                                        <span style="color: #444;">{{ $request->reason }}</span>
                                    </p>
                                @endif
                            </div>

                            <div class="post-actions" style="gap: 10px;">
                                <form action="{{ route('admin.moderator-requests.approve', $request->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="action-btn" style="background: #4CAF50; color: white; padding: 8px 16px; border-radius: 6px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 20px; height: 20px;">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Approve
                                    </button>
                                </form>
                                <form action="{{ route('admin.moderator-requests.reject', $request->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="action-btn" style="background: #f44336; color: white; padding: 8px 16px; border-radius: 6px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 20px; height: 20px;">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        Reject
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="no-posts">
                <img src="{{ asset('asset/forums/No_Post_Icon.svg') }}" alt="No Requests">
                <p>No pending moderator requests</p>
            </div>
        @endif
    </div>
@endsection
