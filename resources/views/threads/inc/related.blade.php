<div id="related-posts">
    <h2>Related questions</h2>
    <ul class="related-posts">
        @if(count($thread) > 0)
            @foreach($related as $thread)
            <li class="related-item"><h3><a href="{{ $thread->path() }}"><i class="icon-double-angle-right"></i>{{ $thread->title }}</a></h3></li>
            @endforeach
        @endif
    </ul>
</div>