@extends('layouts.app')

@section('title', 'Forum - Hearts Whisper')

@section('content')
    <div class="forum-container">
        <h2>Forum Discussions</h2>
        <p class="muted">Area diskusi dan berbagi cerita.</p>

        <div class="posts-list" style="margin-top: 2rem;">
            @forelse ($posts as $post)
                <div class="post-card">
                    <div class="post-votes">
                        <span>{{ $post->likes_count }}</span>
                        <small>Likes</small>
                    </div>
                    <div class="post-content-container">
                        <div class="post-meta">
                            <span>Posted by <a href="#">{{ $post->user->username }}</a></span>
                            <span>&middot;</span>
                            {{-- diffForHumans() akan menampilkan format "5 hours ago" --}}
                            <span>{{ $post->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="post-body">
                            {{-- Str::limit akan memotong konten jika terlalu panjang --}}
                            <p>{{ Illuminate\Support\Str::limit($post->content, 250) }}</p>
                        </div>
                        <div class="post-categories">
                            @foreach ($post->categories as $category)
                                <span class="category-tag">{{ $category->name }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            @empty
                <div class="card">
                    <p>Belum ada postingan. Jadilah yang pertama!</p>
                </div>
            @endforelse

            {{-- Ini akan menampilkan link navigasi halaman (1, 2, 3, ...) --}}
            <div class="pagination-container">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection
