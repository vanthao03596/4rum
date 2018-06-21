@extends('layouts.profile')
@section('page-content')
    @if(Request::segment(3) != null)
        @include('profiles.partials.' . Request::segment(3))
    @else
        @include('profiles.partials.table')
    @endif
<!-- End page-content -->
@stop
