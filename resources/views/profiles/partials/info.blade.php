<div class="col-md-12">
    <div class="page-content">
        <h2>About {{ $user->name }}</h2>
        <div class="user-profile-img"><img width="60" height="60" src="{{ $user->avatar }}" alt="{{ $user->name }}"></div>
        <div class="ul_list ul_list-icon-ok about-user">
            <ul>
                <li><i class="icon-plus"></i>Registerd : <span>{{ $user->created_at->format('M d Y')}}</span></li>
                <li><i class="icon-map-marker"></i>Country : <span>{{ $user->profile->country ?? 'Unknow'}}</span></li>
                <li><i class="icon-globe"></i>Website : <a target="_blank" href="{{ $user->profile->website }}">View</a></li>
            </ul>
        </div>
        <p>{{ $user->profile->about }}</p>
        <div class="clearfix"></div>
        <span class="user-follow-me">Follow Me</span>
        <a href="{{ $user->profile->facebook }}" original-title="Facebook" class="tooltip-n">
            <span class="icon_i">
                <span class="icon_square" icon_size="30" span_bg="#3b5997" span_hover="#2f3239">
                    <i class="social_icon-facebook"></i>
                </span>
            </span>
        </a>
        <a href="{{ $user->profile->twitter }}" original-title="Twitter" class="tooltip-n">
            <span class="icon_i">
                <span class="icon_square" icon_size="30" span_bg="#00baf0" span_hover="#2f3239">
                    <i class="social_icon-twitter"></i>
                </span>
            </span>
        </a>
        <a href="{{ $user->profile->linkedin }}" original-title="Linkedin" class="tooltip-n">
            <span class="icon_i">
                <span class="icon_square" icon_size="30" span_bg="#006599" span_hover="#2f3239">
                    <i class="social_icon-linkedin"></i>
                </span>
            </span>
        </a>
        <a href="{{ $user->profile->google }}" original-title="Google plus" class="tooltip-n">
            <span class="icon_i">
                <span class="icon_square" icon_size="30" span_bg="#c43c2c" span_hover="#2f3239">
                    <i class="social_icon-gplus"></i>
                </span>
            </span>
        </a>
        <a href="{{ $user->profile->email }}" original-title="Email" class="tooltip-n">
            <span class="icon_i">
                <span class="icon_square" icon_size="30" span_bg="#000" span_hover="#2f3239">
                    <i class="social_icon-email"></i>
                </span>
            </span>
        </a>
    </div><!-- End page-content -->
</div><!-- End col-md-12 -->
