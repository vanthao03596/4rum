<header id="header">
    <section class="container clearfix">
        <div class="logo"><a href="{{route('threads.index')}}"><img alt="" src="{{asset('ask-me/images/logo.png')}}"></a></div>
        <nav class="navigation">
            <ul>
                @foreach($channels as $channel)
                    <li><a href="{{ $channel->path() }}">{{ $channel->name }}</a>
                    </li>
                @endforeach
            </ul>
        </nav>
    </section>
    <!-- End container -->
</header>
<!-- End header -->
