@if(count($questions) > 0)
<div class="page-content page-content-user">
    <div class="user-questions">
            @foreach($questions as $thread)
            <article class="question user-question">
                <h3>
                    <a href="{{ $thread->path() }}">{{ $thread->title }}</a>
                </h3>
                <div class="question-type-main"><i class="icon-question-sign"></i>Question</div>
                <div class="question-content">
                    <div class="question-bottom">
                        <div class="question-answered"><i class="icon-ok"></i>in progress</div>
                        <span class="question-favorite"><i class="icon-star"></i>{{ $thread->favorites_count }}</span>
                        <span class="question-category"><a href="{{ route('channels.index', $thread->channel->slug) }}"><i class="icon-folder-close"></i>{{ $thread->channel->name }}</a></span>
                        <span class="question-date"><i class="icon-time"></i>{{ $thread->created_at }}</span>
                        <span class="question-comment"><a href="user_questions.html#"><i class="icon-comment"></i>{{ $thread->replies_count }} Answers</a></span>
                        <a class="question-reply" href="user_questions.html#"><i class="icon-reply"></i>Reply</a>
                        <span class="question-view"><i class="icon-user"></i>{{ $thread->view_count }} views</span>
                    </div>
                </div>
            </article>
            @endforeach
    </div>
</div>
<div class="height_20"></div>
{{ $questions->links() }}
<!-- End pagination -->
<!-- if no questions -->
@else
<p>No questions yet</p>
@endif
