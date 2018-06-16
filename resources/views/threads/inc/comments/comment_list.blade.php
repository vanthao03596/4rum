<ul class="commentlist clearfix">
    @foreach($collection as $comment)
        @include('threads.inc.comments.comment', ['collection' => $comment])
    @endforeach
</ul><!-- End commentlist -->
