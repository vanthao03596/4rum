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
<script>
function lock(id){
    var rs = confirm('@lang('admin.sure')');
        if(rs) {
            document.getElementById('lock-' + id).submit();
        }
    }

</script>
{!! $html->scripts() !!}

@stop
