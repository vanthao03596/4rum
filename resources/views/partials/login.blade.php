<div class="login-panel">
    <section class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="page-content">
                    <h2>Login</h2>
                    <div class="form-style form-style-3">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-inputs clearfix">
                                <p class="login-text">
                                    <input name="email" type="email" value="{{ old('email') ?? 'Email' }}" onfocus="if (this.value == 'Email') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Email';}">
                                    <i class="icon-user"></i>
                                </p>
                                <p class="login-password">
                                    <input name="password" type="password" value="{{ old('email') ?? 'Password' }}" onfocus="if (this.value == 'Password') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Password';}">
                                    <i class="icon-lock"></i>
                                    <a href="index_no_box.html#">Forget</a>
                                </p>
                            </div>
                            <p class="form-submit login-submit">
                                <input type="submit" value="Log in" class="button color small login-submit submit">
                            </p>
                            <div class="rememberme">
                                <label><input name="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}> Remember Me</label>
                            </div>
                        </form>
                    </div>
                </div><!-- End page-content -->
            </div><!-- End col-md-6 -->
            <div class="col-md-6">
                <div class="page-content Register">
                    <h2>Register Now</h2>
                    <p>Register Account to start !</p>
                    <a class="button color small signup">Create an account</a>
                </div><!-- End page-content -->
            </div><!-- End col-md-6 -->
        </div>
    </section>
</div>