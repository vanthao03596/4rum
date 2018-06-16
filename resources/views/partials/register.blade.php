<div class="panel-pop" id="signup">
    <h2>Register Now
        <i class="icon-remove"></i>
    </h2>
    <div class="form-style form-style-3">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-inputs clearfix">
                <p>
                    <label class="required">Username
                        <span>*</span>
                    </label>
                    <input name="name" type="text">
                </p>
                <p>
                    <label class="required">E-Mail
                        <span>*</span>
                    </label>
                    <input name="email" type="email">
                </p>
                <p>
                    <label class="required">Password
                        <span>*</span>
                    </label>
                    <input name="password" type="password" value="">
                </p>
                <p>
                    <label class="required">Confirm Password
                        <span>*</span>
                    </label>
                    <input name="password_confirmation" type="password" value="">
                </p>
            </div>
            <p class="form-submit">
                <input type="submit" value="Signup" class="button color small submit">
            </p>
        </form>
    </div>
</div>