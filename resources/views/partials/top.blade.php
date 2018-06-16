<div id="header-top">
    <section class="container clearfix">
        <nav class="header-top-nav">
            <ul>
                <li><a href="contact_us.html"><i class="icon-envelope"></i>Contact</a></li>
                <li><a href="index_no_box.html#"><i class="icon-headphones"></i>Support</a></li>
                @guest
                <li><a href="login.html" id="login-panel"><i class="icon-user"></i>Login Area</a></li>
                @else
                <li>
                    <a href="#"><i class="icon-user"></i>{{ Auth::user()->name }}</a>
                </li>
                <li><a href=""><i class="icon-wrench"></i>Setting</a></li>
                <li>
                    <a href="{{ route('logout' )}}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}</a></li>
                </li>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

                @endguest
            </ul>
        </nav>
        <div class="header-search">
            <form>
                <input type="text" value="Search here ..." onfocus="if(this.value=='Search here ...')this.value='';" onblur="if(this.value=='')this.value='Search here ...';">
                <button type="submit" class="search-submit"></button>
            </form>
        </div>
    </section><!-- End container -->
</div>