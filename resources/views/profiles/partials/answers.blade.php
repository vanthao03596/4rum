@if($answers->count() > 0)
<div class="page-content page-content-user">
    <div class="user-questions">
        @foreach($answers as $answer)
            <article class="question user-question">
                <h3>
                    <a href="{{ $answer->path() }}">{{ $answer->message }}</a>
                </h3>
                <div class="question-type-main"><i class="icon-question-sign"></i>Question</div>
                <div class="question-content">
                    <div class="question-bottom">
                        <span class="question-favorite"><i class="icon-star"></i>{{ $answer->favorites_count }}</span>
                        <span class="question-category"><a href="user_questions.html#"><i class="icon-folder-close"></i>wordpress</a></span>
                        <span class="question-date"><i class="icon-time"></i>{{ $answer->created_at }}</span>
                        <span class="question-comment"><a href="user_questions.html#"><i class="icon-comment"></i>5 Answers</a></span>
                        <span class="question-view"><i class="icon-user"></i>70 views</span>
                    </div>
                </div>
            </article>
        @endforeach
    </div>
</div>
<div class="height_20"></div>
{{ $answers->links() }}
<!-- End pagination -->
<!-- if no questions -->
@else
<p>No questions yet</p>
@endif
