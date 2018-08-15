<aside class="col-md-3 sidebar">
    @auth
    <div class="widget widget_stats">
        <a href="{{ route('threads.create') }}" style="color:white;"class="button large blue-button">Ask now</a>
    </div>
    <div class="widget widget_stats">
        <h3 class="widget_title">Stats</h3>
        <div class="ul_list ul_list-icon-ok">
            <ul>
            <li><i class="icon-question-sign"></i>
                <a href="{{ url('/threads/?by=' . auth()->user()->name ) }}">Questions ( <span>
                         {{ auth()->user()->threads()->count() }}
                    </span> )</a></li>
                <li><a href="{{ route('profile.answers', auth()->user()->name) }}">
                    <i class="icon-comment"></i>Answers ( <span>
                         {{ auth()->user()->replies()->count() }}
                    </span> )</a>
                </li>
            </ul>
        </div>
    </div>
    @endauth


    <div class="widget widget_social">
        <h3 class="widget_title">Find Us</h3>
        <ul>
            <li class="rss-subscribers">
                <a href="index_no_box.html#" target="_blank">
                    <strong>
                        <i class="icon-rss"></i>
                        <span>Subscribe</span><br>
                        <small>To RSS Feed</small>
                    </strong>
                    </a>
            </li>
            <li class="facebook-fans">
                <a href="index_no_box.html#" target="_blank">
                    <strong>
                        <i class="social_icon-facebook"></i>
                        <span>5,000</span><br>
                        <small>People like it</small>
                    </strong>
                    </a>
            </li>
            <li class="twitter-followers">
                <a href="index_no_box.html#" target="_blank">
                    <strong>
                        <i class="social_icon-twitter"></i>
                        <span>3,000</span><br>
                        <small>Followers</small>
                    </strong>
                    </a>
            </li>
            <li class="youtube-subs">
                <a href="index_no_box.html#" target="_blank">
                    <strong>
                        <i class="icon-play"></i>
                        <span>1,000</span><br>
                        <small>Subscribers</small>
                    </strong>
                    </a>
            </li>
        </ul>
    </div>



    <div class="widget widget_highest_points">
        <h3 class="widget_title">Highest points</h3>
        <ul>
            @if($topUsers->count() > 0)
                @foreach($topUsers as $user)
                    <li>
                        <div class="author-img">
                            <a href="{{ route('profile.show', $user->name) }}"><img width="60" height="60" src="{{ $user->avatar }}" alt="{{ $user->name }}"></a>
                        </div>
                        <h6><a href="{{ route('profile.show', $user->name) }}">{{ $user->name }}</a></h6>
                        <span class="comment">{{ $user->point }} {{ str_plural('Points', $user->point) }}</span>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>

    <div class="widget widget_tag_cloud">
        <h3 class="widget_title">Tags</h3>
        @foreach($allTags as $tag)
            <a href="{{ route('tags.index', $tag) }}">{{ $tag }}</a>
        @endforeach

    </div>

    <div class="widget">
        <h3 class="widget_title">Recent Questions</h3>
        <ul class="related-posts">
            @foreach($latestQuestions as $question)
                <li class="related-item">
                    <h3><a href="{{ $question->path() }}">{{ $question->title }}</a></h3>
                    <div class="clear"></div><span>{{ $question->created_at }}</span>
                </li>
            @endforeach
        </ul>
    </div>

</aside>
