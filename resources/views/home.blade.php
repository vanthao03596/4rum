@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>

                    @endif
                    <form action="{{ route('test') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <input type="file" name="uploadFile">
                        <button type="submit">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
