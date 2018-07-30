<div class="share-tags page-content">
    <div class="question-tags"><i class="icon-tags"></i>
        @if(count($thread->tags) > 0)
            @foreach($thread->tags as $tag)
                <a href="{{ route('tags.index', $tag->name) }}">{{ $tag->name }}</a>,
            @endforeach
        @endif

    </div>
    <div class="share-inside-warp">
        <ul>
            <li>
                <a href="single_question.html#" original-title="Facebook">
                    <span class="icon_i">
                        <span class="icon_square" icon_size="20" span_bg="#3b5997" span_hover="#666">
                            <i i_color="#FFF" class="social_icon-facebook"></i>
                        </span>
                    </span>
                </a>
                <a href="single_question.html#" target="_blank">Facebook</a>
            </li>
            <li>
                <a href="single_question.html#" target="_blank">
                    <span class="icon_i">
                        <span class="icon_square" icon_size="20" span_bg="#00baf0" span_hover="#666">
                            <i i_color="#FFF" class="social_icon-twitter"></i>
                        </span>
                    </span>
                </a>
                <a target="_blank" href="single_question.html#">Twitter</a>
            </li>
            <li>
                <a href="single_question.html#" target="_blank">
                    <span class="icon_i">
                        <span class="icon_square" icon_size="20" span_bg="#ca2c24" span_hover="#666">
                            <i i_color="#FFF" class="social_icon-gplus"></i>
                        </span>
                    </span>
                </a>
                <a href="single_question.html#" target="_blank">Google plus</a>
            </li>
            <li>
                <a href="single_question.html#" target="_blank">
                    <span class="icon_i">
                        <span class="icon_square" icon_size="20" span_bg="#e64281" span_hover="#666">
                            <i i_color="#FFF" class="social_icon-dribbble"></i>
                        </span>
                    </span>
                </a>
                <a href="single_question.html#" target="_blank">Dribbble</a>
            </li>
            <li>
                <a target="_blank" href="single_question.html#">
                    <span class="icon_i">
                        <span class="icon_square" icon_size="20" span_bg="#c7151a" span_hover="#666">
                            <i i_color="#FFF" class="icon-pinterest"></i>
                        </span>
                    </span>
                </a>
                <a href="single_question.html#" target="_blank">Pinterest</a>
            </li>
        </ul>
        <span class="share-inside-f-arrow"></span>
        <span class="share-inside-l-arrow"></span>
    </div><!-- End share-inside-warp -->
    <div class="share-inside"><i class="icon-share-alt"></i>Share</div>
    <div class="clearfix"></div>
</div>
