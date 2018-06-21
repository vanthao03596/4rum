<reply :attributes="{{ $comment }}" inline-template v-cloak>
<li class="comment">
    <div id="reply-{{ $comment->id }}" class="comment-body clearfix">
        <div class="avatar"><a href="{{ route('profile.show', $comment->owner->name )}}" original-title="{{ $comment->owner->name }}" class="tooltip-n"><img alt="" src="{{ Avatar::create($comment->owner->name)->toBase64() }}"></a></div>
        <div class="comment-text">
            <div class="author clearfix">
            <div class="comment-author"><a href="{{ route('profile.show', $comment->owner->name )}}">{{ $comment->owner->name }}</a></div>
                @auth
                    <favorite :reply="{{ $comment }}"></favorite>
                @endauth
                <div class="comment-meta">
                <div class="date"><i class="icon-time"></i>{{ $comment->created_at->diffForHumans() }}</div>
                </div>
                <a class="comment-reply" href="single_question.html#"><i class="icon-reply"></i>Reply</a>
            </div>
            <div class="text">
                <div v-if="editing">
                    <textarea style="width: 100%;" v-model="message">{{ $comment->message }}</textarea>
                    <button class="button mini blue-button" @click="update">Update</button>
                    <button class="button mini" @click="cancel">Cancel</button>
                </div>
                <div v-else>
                    <p v-text="message"></p>
                </div>
                @can('delete', $comment)
                    <button class="button mini blue-button" v-if="!editing" @click="editing = true">Edit</button>
                    <button class="button mini red-button" v-if="!editing" @click="destroy">Delete</button>
                    {{-- <form action="{{ route('replies.delete', $comment->id) }}" method="post" style="display: inline-block;">
                        @csrf
                        @method('delete')
                        <button type="submit" class="button mini red-button">Delete</button>
                    </form> --}}
                @endcan
            </div>
        </div>

    </div>
    @if (isset($comments[$comment->id]))
        @include('threads.inc.comments.comment_child', ['collection' => $comments[$comment->id]])
    @endif
</li>

</reply>
