@extends('adminlte::page')

@section('title', trans('admin.replies'))

@section('content_header')
<div class="box-header">
     {{ Breadcrumbs::view('admin.partials.breadcrumbs', 'admin.replies') }}
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
<script>

function deleteReply(id) {
    var rs = confirm('@lang('admin.sure')');
        if(rs) {
            document.getElementById('delete-' + id).submit();
        }
    }
</script>
{!! $html->scripts() !!}

@stop
