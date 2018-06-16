<div class="col-md-12">
    <div class="page-content">
        <h2>About {{ $user->name }}</h2>
        <div class="user-profile-img"><img width="60" height="60" src="{{ Avatar::create($user->name)->toBase64() }}" alt="{{ $user->name }}"></div>
        <div class="ul_list ul_list-icon-ok about-user">
            <ul>
                <li><i class="icon-plus"></i>Registerd : <span>{{ $user->created_at->format('M d Y')}}</span></li>
                <li><i class="icon-map-marker"></i>Country : <span>Egypt</span></li>
                <li><i class="icon-globe"></i>Website : <a target="_blank" href="https://2code.info/">view</a></li>
            </ul>
        </div>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravida odio, sit amet suscipit risus ultrices eu. Fusce viverra neque at purus laoreet consequat. Vivamus vulputate posuere nisl quis consequat. Donec congue commodo mi, sed commodo velit fringilla ac. Fusce placerat venenatis mi. Pellentesque habitant morbi tristique senectus et netus et malesuada .</p>
        <div class="clearfix"></div>
        <span class="user-follow-me">Follow Me</span>
        <a href="user_profile.html#" original-title="Facebook" class="tooltip-n">
            <span class="icon_i">
                <span class="icon_square" icon_size="30" span_bg="#3b5997" span_hover="#2f3239">
                    <i class="social_icon-facebook"></i>
                </span>
            </span>
        </a>
        <a href="user_profile.html#" original-title="Twitter" class="tooltip-n">
            <span class="icon_i">
                <span class="icon_square" icon_size="30" span_bg="#00baf0" span_hover="#2f3239">
                    <i class="social_icon-twitter"></i>
                </span>
            </span>
        </a>
        <a href="user_profile.html#" original-title="Linkedin" class="tooltip-n">
            <span class="icon_i">
                <span class="icon_square" icon_size="30" span_bg="#006599" span_hover="#2f3239">
                    <i class="social_icon-linkedin"></i>
                </span>
            </span>
        </a>
        <a href="user_profile.html#" original-title="Google plus" class="tooltip-n">
            <span class="icon_i">
                <span class="icon_square" icon_size="30" span_bg="#c43c2c" span_hover="#2f3239">
                    <i class="social_icon-gplus"></i>
                </span>
            </span>
        </a>
        <a href="user_profile.html#" original-title="Email" class="tooltip-n">
            <span class="icon_i">
                <span class="icon_square" icon_size="30" span_bg="#000" span_hover="#2f3239">
                    <i class="social_icon-email"></i>
                </span>
            </span>
        </a>
    </div><!-- End page-content -->
</div><!-- End col-md-12 -->