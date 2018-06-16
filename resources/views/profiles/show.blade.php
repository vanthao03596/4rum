@extends('layouts.profile')
@section('page-content')
    @if(isset($questions))
        @include('profiles.partials.questions')
    @elseif (isset($favQuestions))
        @include('profiles.partials.favorite_questions')
    @elseif (isset($answers))
        @include('profiles.partials.answers')
    @elseif (isset($history))
        @include('profiles.partials.points')
    @else
        @include('profiles.partials.table')
    @endif
<!-- End page-content -->
@stop