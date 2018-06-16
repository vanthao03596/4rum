<div class="about-author clearfix">
    <div class="author-image">
        <a href="{{ route('profile.show', $thread->creator->name) }}" original-title="{{ $thread->creator->name }}" class="tooltip-n"><img src="{{ Avatar::create($thread->creator->name)->toBase64() }}" /></a>
    </div>
    <div class="author-bio">
        <h4>About {{ $thread->creator->name }}</h4>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed viverra auctor neque. Nullam lobortis, sapien vitae lobortis tristique.
    </div>
</div>
