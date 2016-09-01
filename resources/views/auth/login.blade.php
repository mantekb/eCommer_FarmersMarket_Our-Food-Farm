@extends('layouts.default')

@section('title', 'Login')

@section('content')
<div class="col m8 push-m2">
    <div class="card">
        <div class="card-content">
            <div class="card-title">Login</div>
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}

                <div class="input-field{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">E-Mail Address</label>

                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="input-field{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password">Password</label>

                    <input id="password" type="password" class="form-control" name="password">

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
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
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-btn fa-sign-in"></i> Login
                        </button>

                        <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
