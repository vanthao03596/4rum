@extends('layouts.master')
@section('breadcrumbs', Breadcrumbs::render('home'))
@section('content')
<section class="container main-content page-full-width">
    <div class="row">
        <div class="contact-us">
            <div class="col-md-12">
                <div class="page-content">
                    <iframe height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.839609564807!2d105.8762848145507!3d20.999065486014487!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135aeaa29c23adb%3A0xd5e3ff295ea5edb9!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBLaW5oIGRvYW5oIHbDoCBDw7RuZyBuZ2jhu4cgSMOgIE7hu5lp!5e0!3m2!1svi!2s!4v1534169026219"></iframe>
                </div><!-- End page-content -->
            </div>
            <div class="col-md-7">
                <div class="page-content">
                    <h2>Say hello !</h2>
                    <form class="form-style form-style-3 form-style-5" action="{{ route('contact.store') }}" method="post">
                        <div class="form-inputs clearfix">
                            @csrf
                            <p>
                                <label for="name" class="required">Name<span>*</span></label>
                                <input type="text" class="required-item" value="{{ old('name') }}" name="name" id="name" aria-required="true">
                            </p>
                            <p>
                                <label for="email" class="required">E-Mail<span>*</span></label>
                                <input type="email" class="required-item" id="email" name="email" value="{{ old('email') }}" aria-required="true">
                            </p>
                            <p>
                                <label for="website" class="required">Website</label>
                                <input type="text" id="website" name="website" value="{{ old('website') }}">
                            </p>
                        </div>
                        <div class="form-textarea">
                            <p>
                                <label for="message" class="required">Message<span>*</span></label>
                                <textarea id="message" class="required-item" name="message" aria-required="true" cols="58" rows="7">{{ old('message') }}</textarea>
                            </p>
                        </div>
                        <p class="form-submit">
                            <input name="submit" type="submit" value="Send" class="submit button small color">
                        </p>
                    </form>
                </div><!-- End page-content -->
            </div><!-- End col-md-6 -->
            <div class="col-md-5">
                <div class="page-content">
                    <h2>About Us</h2>
                    <p>{{ config('footer.about') }}</p>
                    <div class="widget widget_contact">
                        <ul>
                            <li><i class="icon-map-marker"></i>Address :<p>{{ config('footer.address') }}</p></li>
                            <li><i class="icon-phone"></i>Phone number :<p>{{ config('footer.phone') }}</p></li>
                            <li><i class="icon-envelope-alt"></i>E-mail :<p>{{ config('footer.email') }}</p></li>
                            <li>
                                <i class="icon-share"></i>Social links :
                                <p>
                                    <a href="{{ config('footer.facebook') }}" original-title="Facebook" class="tooltip-n">
                                        <span class="icon_i">
                                            <span class="icon_square" icon_size="25" span_bg="#3b5997" span_hover="#2f3239">
                                                <i i_color="#FFF" class="social_icon-facebook"></i>
                                            </span>
                                        </span>
                                    </a>
                                    <a href="{{ config('footer.twitter') }}" original-title="Twitter" class="tooltip-n">
                                        <span class="icon_i">
                                            <span class="icon_square" icon_size="25" span_bg="#00baf0" span_hover="#2f3239">
                                                <i i_color="#FFF" class="social_icon-twitter"></i>
                                            </span>
                                        </span>
                                    </a>
                                    <a original-title="Youtube" class="tooltip-n" href="{{ config('footer.youtube') }}">
                                        <span class="icon_i">
                                            <span class="icon_square" icon_size="25" span_bg="#cc291f" span_hover="#2f3239">
                                                <i i_color="#FFF" class="social_icon-youtube"></i>
                                            </span>
                                        </span>
                                    </a>
                                    <a href="{{ config('footer.linkedin') }}" original-title="Linkedin" class="tooltip-n">
                                        <span class="icon_i">
                                            <span class="icon_square" icon_size="25" span_bg="#006599" span_hover="#2f3239">
                                                <i i_color="#FFF" class="social_icon-linkedin"></i>
                                            </span>
                                        </span>
                                    </a>
                                    <a href="{{ config('footer.google') }}" original-title="Google plus" class="tooltip-n">
                                        <span class="icon_i">
                                            <span class="icon_square" icon_size="25" span_bg="#ca2c24" span_hover="#2f3239">
                                                <i i_color="#FFF" class="social_icon-gplus"></i>
                                            </span>
                                        </span>
                                    </a>
                                    <a original-title="RSS" class="tooltip-n" href="contact_us.html#">
                                        <span class="icon_i">
                                            <span class="icon_square" icon_size="25" span_bg="#F18425" span_hover="#2f3239">
                                                <i i_color="#FFF" class="icon-rss"></i>
                                            </span>
                                        </span>
                                    </a>
                                    <a original-title="Instagram" class="tooltip-n" href="contact_us.html#">
                                        <span class="icon_i">
                                            <span class="icon_square" icon_size="25" span_bg="#306096" span_hover="#2f3239">
                                                <i i_color="#FFF" class="social_icon-instagram"></i>
                                            </span>
                                        </span>
                                    </a>
                                    <a original-title="Dribbble" class="tooltip-n" href="contact_us.html#">
                                        <span class="icon_i">
                                            <span class="icon_square" icon_size="25" span_bg="#e64281" span_hover="#2f3239">
                                                <i i_color="#FFF" class="social_icon-dribbble"></i>
                                            </span>
                                        </span>
                                    </a>
                                    <a original-title="Pinterest" class="tooltip-n" href="contact_us.html#">
                                        <span class="icon_i">
                                            <span class="icon_square" icon_size="25" span_bg="#c7151a" span_hover="#2f3239">
                                                <i i_color="#FFF" class="icon-pinterest"></i>
                                            </span>
                                        </span>
                                    </a>
                                </p>
                            </li>
                        </ul>
                    </div>
                </div><!-- End page-content -->
            </div><!-- End col-md-6 -->
        </div><!-- End contact-us -->
    </div><!-- End row -->
</section><!-- End container -->

@stop
