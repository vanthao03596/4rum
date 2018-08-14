@extends('adminlte::page')

@section('title', trans('admin.contacts'))

@section('content_header')
<div class="box-header">
     {{ Breadcrumbs::view('admin.partials.breadcrumbs', 'admin.contacts') }}
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
