<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="{{ app()->getLocale() }}"> <!--<![endif]-->
<head>

	<!-- Basic Page Needs -->
	<meta charset="utf-8">
	<title>Ask me</title>
	<meta name="description" content="Ask me">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<!-- Main Style -->
	<link rel="stylesheet" href="{{ asset('ask-me/style.css') }}">

	<!-- Skins -->
	<link rel="stylesheet" href="{{ asset('ask-me/css/skins/skins.css') }}">

	<!-- Responsive Style -->
    <link rel="stylesheet" href="{{ asset('ask-me/css/responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/default.min.css') }}">
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.atwho.css') }}">  -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/trix.css')}}">
  <style type="text/css">
    [v-cloak] { display:none; }

  </style>
	<!-- Favicons -->
  <link rel="shortcut icon" href="{{ asset('ask-me/images/favicon.png') }}">
  <script>
    window.App = @json([
      'user' => auth()->user(),
      'signedIn' => auth()->check(),
      'baseUrl' => config('app.url')
    ])
  </script>
</head>
<body>

<div class="loader">
  <div class="sk-circle">
  <div class="sk-circle1 sk-child"></div>
  <div class="sk-circle2 sk-child"></div>
  <div class="sk-circle3 sk-child"></div>
  <div class="sk-circle4 sk-child"></div>
  <div class="sk-circle5 sk-child"></div>
  <div class="sk-circle6 sk-child"></div>
  <div class="sk-circle7 sk-child"></div>
  <div class="sk-circle8 sk-child"></div>
  <div class="sk-circle9 sk-child"></div>
  <div class="sk-circle10 sk-child"></div>
  <div class="sk-circle11 sk-child"></div>
  <div class="sk-circle12 sk-child"></div>
</div>
</div>

<div id="wrap" class="grid_1200">

    @include('partials.login')
    <!-- End login-panel -->

    @include('partials.register')
    <!-- End signup -->

    @include('partials.password')
    <!-- End lost-password -->
  <div id="app">
	@include('partials.top')
    <!-- End header-top -->
  	@include('partials.header')

  	@yield('breadcrumbs')

  	@include('partials.status')


    @yield('content')
    <!-- End container -->
  </div>

	@render(\App\ViewComponents\FooterComponent::class)<!-- End footer-bottom -->
</div><!-- End wrap -->

<div class="go-up"><i class="icon-chevron-up"></i></div>

<!-- js -->
<script src="{{ asset('js/app.js') }}"></script>

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
<script src="{{ asset('js/toastr.js') }}"></script>
<script src="{{ asset('js/highlight.min.js') }}"></script>

<script>
    $(document).ready(function() {
  $('pre').each(function(i, block) {
    hljs.highlightBlock(block);
  });
});</script>

@if(session()->get('status'))
<script type="text/javascript">
    toastr.options = {
      "closeButton": false,
      "debug": false,
      "newestOnTop": false,
      "progressBar": false,
      "positionClass": "toast-bottom-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
    toastr.success('{{ session()->get('status' )}}', 'SYSTEM')
</script>
@endif
@yield('js')
<!-- End js -->

</body>
</html>
