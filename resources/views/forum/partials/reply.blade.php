<div class="reply-item" style="margin-left: {{ $level * 2 }}rem;">
    <div class="reply-header">
        @if(strtolower($reply->user->gender) === 'female')
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

    <div class="reply-content">
        <p>{{ $reply->content }}</p>
    </div>

    <div class="reply-actions-bar">
        <button class="reply-action-btn like-reply-btn" data-reply-id="{{ $reply->id }}" data-liked="false">
            <img src="{{ asset('asset/forums/unliked.svg') }}" alt="like" class="like-icon-small">
            Like ({{ $reply->likes_count }})
        </button>
        <button class="reply-action-btn nested-reply-toggle" data-reply-id="{{ $reply->id }}">
            <img src="{{ asset('asset/forums/replybutton.svg') }}" alt="reply" class="reply-icon-small">
            Reply
        </button>
    </div>

    <!-- Nested Reply Form (Hidden by default) -->
    <div class="nested-reply-form" id="nested-reply-{{ $reply->id }}" style="display: none;">
        <form class="nested-reply-form-inner" data-parent-id="{{ $reply->id }}" data-post-id="{{ $reply->post_id }}">
            @csrf
            <textarea class="reply-textarea-small" placeholder="Write your reply..." rows="2" maxlength="500" required></textarea>
            <div class="nested-reply-actions">
                <button type="button" class="cancel-nested-reply" data-reply-id="{{ $reply->id }}">Cancel</button>
                <button type="submit" class="submit-nested-reply">Reply</button>
            </div>
        </form>
    </div>

    <!-- Nested Replies -->
    @if($reply->replies->count() > 0)
        <div class="nested-replies">
            @foreach($reply->replies as $nestedReply)
                @include('forum.partials.reply', ['reply' => $nestedReply, 'level' => $level + 1])
            @endforeach
        </div>
    @endif
</div>
