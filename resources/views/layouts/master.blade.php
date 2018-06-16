<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

	<!-- Basic Page Needs -->
	<meta charset="utf-8">
	<title>Ask me – Responsive Questions and Answers Template</title>
	<meta name="description" content="Ask me Responsive Questions and Answers Template">
	<meta name="author" content="2code.info">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<!-- Main Style -->
	<link rel="stylesheet" href="{{ asset('ask-me/style.css') }}">

	<!-- Skins -->
	<link rel="stylesheet" href="{{ asset('ask-me/css/skins/skins.css') }}">

	<!-- Responsive Style -->
    <link rel="stylesheet" href="{{ asset('ask-me/css/responsive.css') }}">

	<!-- Favicons -->
	<link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">

</head>
<body>

<div class="loader"><div class="loader_html"></div></div>

<div id="wrap" class="grid_1200">

    @include('partials.login')
    <!-- End login-panel -->

    @include('partials.register')
    <!-- End signup -->

    @include('partials.password')
    <!-- End lost-password -->

	@include('partials.top')
    <!-- End header-top -->
	@include('partials.header')

	@yield('breadcrumbs')

	@include('partials.status')

	@yield('content')<!-- End container -->

	@include('partials.footer')<!-- End footer-bottom -->
</div><!-- End wrap -->

<div class="go-up"><i class="icon-chevron-up"></i></div>

<!-- js -->
<script src="{{ asset('ask-me/js/jquery.min.js') }}"></script>
<script src="{{ asset('ask-me/js/jquery-ui-1.10.3.custom.min.js') }}"></script>
<script src="{{ asset('ask-me/js/jquery.easing.1.3.min.js') }}"></script>
<script src="{{ asset('ask-me/js/html5.js') }}"></script>
{{-- <script src="{{ asset('ask-me/js/twitter/jquery.tweet.js') }}"></script> --}}
<script src="{{ asset('ask-me/js/jflickrfeed.min.js') }}"></script>
<script src="{{ asset('ask-me/js/jquery.inview.min.js') }}"></script>
<script src="{{ asset('ask-me/js/jquery.tipsy.js') }}"></script>
<script src="{{ asset('ask-me/js/tabs.js') }}"></script>
<script src="{{ asset('ask-me/js/jquery.flexslider.js') }}"></script>
<script src="{{ asset('ask-me/js/jquery.prettyPhoto.js') }}"></script>
<script src="{{ asset('ask-me/js/jquery.carouFredSel-6.2.1-packed.js') }}"></script>
<script src="{{ asset('ask-me/js/jquery.scrollTo.js') }}"></script>
<script src="{{ asset('ask-me/js/jquery.nav.js') }}"></script>
<script src="{{ asset('ask-me/js/tags.js') }}"></script>
<script src="{{ asset('ask-me/js/jquery.bxslider.min.js') }}"></script>
<script src="{{ asset('ask-me/js/custom.js') }}"></script>
<!-- End js -->

</body>
</html>
