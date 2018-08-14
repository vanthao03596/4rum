@extends('layouts.master')

@section('content')
<section class="container main-content">
    <div class="login">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="page-content">
                    <h2>Lost Password<i class="icon-remove"></i></h2>
                    <div class="form-style form-style-3">
                        <p>Lost your password? Please enter your username and email address. You will receive a link to create a new password via email.</p>
                        <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                            <div class="form-inputs clearfix">
                                <p>
                                    <label class="required">E-Mail<span>*</span></label>
                                    <input type="email" name="email" value="{{ old('email') }}">
                                </p>
                            </div>
                            <p class="form-submit">
                                <input type="submit" value="Reset" class="button color small submit">
                            </p>
                        </form>
                        <div class="clearfix"></div>
                    </div>
                </div><!-- End page-content -->
            </div><!-- End col-md-6 -->
        </div><!-- End row -->
    </div><!-- End login -->
</section><!-- End container -->
@endsection
