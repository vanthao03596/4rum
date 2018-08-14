@extends('layouts.master')

@section('content')
<section class="container main-content">
    <div class="login">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="page-content">
                    <h2>Reset Password<i class=""></i></h2>
                    <div class="form-style form-style-3">
                    <form method="POST" action="{{ route('password.request') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-inputs clearfix">
                            <p>
                                <label for="email" class="required">{{ __('E-Mail Address') }}<span>*</span><</label>
                                <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}" required autofocus>
                            </p>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif

                            <p>
                                <label for="password" class="required">{{ __('Password') }}<span>*</span><</label>

                                <input id="password" type="password" name="password" required>
                            </p>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

                            <p>
                                <label for="password-confirm" class="required">{{ __('Confirm Password') }}<span>*</span><</label>

                                <input id="password-confirm" type="password" name="password_confirmation" required>
                            </p>
                        </div>

                        <p class="form-submit">
                                <input type="submit" value=" {{ __('Reset Password') }}" class="button color small submit">
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

