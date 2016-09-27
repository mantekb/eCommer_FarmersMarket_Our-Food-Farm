<div style="display: none;" class="loginForm col m8 push-m2">
    <div class="card">
        <div class="card-content">
            <div class="card-title">Login</div>
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}

                <div class="input-field{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">E-Mail Address</label>

                    <input id="email" type="email" class="validate form-control" name="email" value="{{ old('email') }}">

                    <span style="display: none;" class="help-block">
                        <strong id="loginError"></strong>
                    </span>
                </div>

                <div class="input-field{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password">Password</label>

                    <input id="password" type="password" class="validate form-control" name="password">

                </div>

                <div class="input-field">
                    <div class="col m6 push-m4">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember"> Remember Me
                            </label>
                        </div>
                    </div>
                </div>

                <div class="input-field">
                    <div class="col m6 push-m4">
                        <button type="submit" class="loginSubmit btn btn-primary">
                            <i class="fa fa-btn fa-sign-in"></i> Login
                        </button>

                        <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>