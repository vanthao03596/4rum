@extends('adminlte::page')

@section('title', trans('admin.threads'))

@section('content_header')
<div class="box-header">
     {{ Breadcrumbs::view('admin.partials.breadcrumbs', 'admin.threads.index') }}
</div>

@stop

@section('content')
<div class="box-body">
    {!! $html->table() !!}
</div>


@stop

@section('css')
@stop

@section('js')
{!! $html->scripts() !!}
@stop
