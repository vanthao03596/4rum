@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="box-header">
        {{ Breadcrumbs::view('admin.partials.breadcrumbs', 'admin.dashboard') }}
   </div>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
    {{ auth('admin')->user()->name }}
@stop

@section('css')
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop