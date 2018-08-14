@extends('layouts.master')

@section('breadcrumbs', Breadcrumbs::render('errors.404'))

@section('content')
<section class="container main-content">
    <div class="row">
        <div class="col-md-12">
            <div class="error_404">
                <div>
                    <h2>404</h2>
                    <h3>Page not Found</h3>
                </div>
                <div class="clearfix"></div><br>
                <a href="{{ route('threads.index') }}" class="button large color margin_0">Home Page</a>
            </div>
        </div><!-- End main -->
    </div><!-- End row -->
</section>
@stop
