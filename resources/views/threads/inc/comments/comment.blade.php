<li class="comment">
    <div class="comment-body clearfix">
        <div class="avatar"><a href="{{ route('profile.show', $comment->owner->name )}}" original-title="{{ $comment->owner->name }}" class="tooltip-n"><img alt="" src="{{ Avatar::create($comment->owner->name)->toBase64() }}"></a></div>
        <div class="comment-text">
            <div class="author clearfix">
            <div class="comment-author"><a href="{{ route('profile.show', $comment->owner->name )}}">{{ $comment->owner->name }}</a></div>
                <div class="comment-vote">
                        <ul class="single-question-vote" style="width:70px">
                            <li><a href="#" class="single-question-vote-down" title="Dislike"><i class="icon-thumbs-down"></i></a></li>
                            <li>
                            <a href="#" class="single-question-vote-up {{ $comment->isFavorited() ? 'like' : ''}}" title="Like"><i class="icon-thumbs-up"
                                    onclick="event.preventDefault();
                                document.getElementById('form-like{{$comment->id}}').submit();"></i>
                                </a>
                            </li>
                            <form method="POST" id="form-like{{$comment->id}}" action="{{ route('like', $comment->id) }}">
                                    @csrf
                            </form>
                        </ul>
                </div>
                <span class="question-vote-result">+{{ $comment->favorites_count }}</span>
                <div class="comment-meta">
                <div class="date"><i class="icon-time"></i>{{ $comment->created_at->diffForHumans() }}</div>
                </div>
                <a class="comment-reply" href="single_question.html#"><i class="icon-reply"></i>Reply</a>
            </div>
            <div class="text"><p>{{ $comment->message }}.</p>
            </div>
        </div>
    </div>
    @if (isset($comments[$comment->id]))
        @include('threads.inc.comments.comment_child', ['collection' => $comments[$comment->id]])
    @endif
</li>
