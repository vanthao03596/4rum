@extends('layouts.master')
@section('content')
@section('breadcrumbs', Breadcrumbs::render('profile', $user))

<section class="container main-content">
    <div class="row">
        <div class="col-md-9">
            <div class="row">
                <div class="user-profile">
                    @include('profiles.partials.info')
                    @include('profiles.partials.stats')
                    <!-- End col-md-12 -->
                </div><!-- End user-profile -->
            </div><!-- End row -->
            <div class="clearfix"></div>
            @yield('page-content')
        </div><!-- End main -->
        @include('partials.sidebar')
    </div><!-- End row -->
</section><!-- End container -->

@stop