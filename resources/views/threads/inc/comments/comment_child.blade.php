<ul class="children">
    @foreach($collection as $comment)
        @include('threads.inc.comments.comment', ['collection' => $comment])
    @endforeach
</ul>
