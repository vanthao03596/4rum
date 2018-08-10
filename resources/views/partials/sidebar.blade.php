<aside class="col-md-3 sidebar">
    @auth
    <div class="widget widget_stats">
        <a href="{{ route('threads.create') }}" style="color:white;"class="button large blue-button">Ask now</a>
    </div>
    @endauth
    <div class="widget widget_stats">
        <h3 class="widget_title">Stats</h3>
        <div class="ul_list ul_list-icon-ok">
            <ul>
            <li><i class="icon-question-sign"></i>
                @auth
                <a href="{{ url('/threads/?by=' . auth()->user()->name ) }}">Questions ( <span>
                         {{ auth()->user()->threads()->count() }}
                    </span> )</a></li>
                @endauth
                @auth
                <li><i class="icon-comment"></i>Answers ( <span>
                         {{ auth()->user()->replies()->count() }}
                </span> )</li>
                @endauth
            </ul>
        </div>
    </div>

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
            <li>
                <div class="author-img">
                    <a href="index_no_box.html#"><img width="60" height="60" src="{{ asset('images/admin.jpeg') }}" alt=""></a>
                </div>
                <h6><a href="index_no_box.html#">admin</a></h6>
                <span class="comment">12 Points</span>
            </li>
            <li>
                <div class="author-img">
                    <a href="index_no_box.html#"><img width="60" height="60" src="{{ asset('images/avatar.png') }}" alt=""></a>
                </div>
                <h6><a href="index_no_box.html#">vbegy</a></h6>
                <span class="comment">10 Points</span>
            </li>
            <li>
                <div class="author-img">
                    <a href="index_no_box.html#"><img width="60" height="60" src="{{ asset('images/avatar.png') }}" alt=""></a>
                </div>
                <h6><a href="index_no_box.html#">ahmed</a></h6>
                <span class="comment">5 Points</span>
            </li>
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
            <li class="related-item">
                <h3><a href="index_no_box.html#">This is my first Question</a></h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <div class="clear"></div><span>Feb 22, 2014</span>
            </li>
            <li class="related-item">
                <h3><a href="index_no_box.html#">This Is My Second Poll Question</a></h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <div class="clear"></div><span>Feb 22, 2014</span>
            </li>
        </ul>
    </div>

</aside>
