<div class="reply-item" style="margin-left: {{ $level * 2 }}rem;">
    <div class="reply-header">
        @if (strtolower($reply->user->gender) === 'female')
            <img src="{{ asset('asset/forums/girl.svg') }}" alt="Female Avatar" class="reply-avatar">
        @else
            <img src="{{ asset('asset/forums/boi.svg') }}" alt="Male Avatar" class="reply-avatar">
        @endif
        <div class="reply-meta">
            <span class="reply-author">{{ $reply->user->username }}</span>
            <span>&middot;</span>
            <span class="reply-time">{{ $reply->created_at->diffForHumans() }}</span>
        </div>
    </div>

    <div class="reply-content" id="reply-content-{{ $reply->id }}">
        <p>{{ $reply->content }}</p>
    </div>

    <!-- Edit Form (Hidden by default) -->
    <div class="reply-edit-form" id="reply-edit-{{ $reply->id }}" style="display: none;">
        <form class="reply-edit-form-inner" data-reply-id="{{ $reply->id }}">
            @csrf
            @method('PUT')
            <textarea class="reply-textarea-small" id="edit-textarea-{{ $reply->id }}" rows="3" maxlength="1000" required>{{ $reply->content }}</textarea>
            <div class="nested-reply-actions">
                <button type="button" class="cancel-edit-reply" data-reply-id="{{ $reply->id }}">Cancel</button>
                <button type="submit" class="submit-edit-reply">Update</button>
            </div>
        </form>
    </div>

    <div class="reply-actions-bar">
        @php
            $isLiked = auth()->check() && $reply->isLikedBy(auth()->user());
        @endphp
        <button class="reply-action-btn like-reply-btn" 
                onclick="toggleLike(event, {{ $reply->id }}, 'reply')" 
                data-reply-id="{{ $reply->id }}" 
                data-liked="{{ $isLiked ? 'true' : 'false' }}">
            <img src="{{ asset($isLiked ? 'asset/forums/liked.svg' : 'asset/forums/unliked.svg') }}" alt="like" class="like-icon-small reply-like-icon-{{ $reply->id }}">
            <span class="like-text">{{ $isLiked ? 'Liked' : 'Like' }}</span> <span class="like-count reply-like-count-{{ $reply->id }}">({{ $reply->likes_count }})</span>
        </button>
        <button class="reply-action-btn nested-reply-toggle" data-reply-id="{{ $reply->id }}">
            <img src="{{ asset('asset/forums/replybutton.svg') }}" alt="reply" class="reply-icon-small">
            Reply
        </button>
        
        @auth
            @if($reply->user_id === auth()->id())
                <button class="reply-action-btn edit-reply-btn-trigger" data-reply-id="{{ $reply->id }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 16px; height: 16px;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit
                </button>
                <button class="reply-action-btn delete-reply-btn-trigger" data-reply-id="{{ $reply->id }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 16px; height: 16px;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    Delete
                </button>
            @endif
        @endauth
    </div>

    <!-- Nested Reply Form (Hidden by default) -->
    <div class="nested-reply-form" id="nested-reply-{{ $reply->id }}" style="display: none;">
        <form class="nested-reply-form-inner" data-parent-id="{{ $reply->id }}"
            data-post-id="{{ $reply->post_id }}">
            @csrf
            <textarea class="reply-textarea-small" placeholder="Write your reply..." rows="2" maxlength="500" required></textarea>
            <div class="nested-reply-actions">
                <button type="button" class="cancel-nested-reply" data-reply-id="{{ $reply->id }}">Cancel</button>
                <button type="submit" class="submit-nested-reply">Reply</button>
            </div>
        </form>
    </div>

    <!-- Nested Replies -->
    @if ($reply->replies->count() > 0)
        <div class="nested-replies">
            @foreach ($reply->replies as $nestedReply)
                @include('forum.partials.reply', ['reply' => $nestedReply, 'level' => $level + 1])
            @endforeach
        </div>
    @endif
</div>
