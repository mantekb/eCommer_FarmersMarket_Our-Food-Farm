@extends('layouts.default')

@section('title', 'Forgotten Password')

@section('content')
<div class="row">
    <div class="card">
        <div class="card-content">
            <div class="card-title">Reset Password</div>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
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

                <div class="input-field">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-btn fa-envelope"></i> Send Password Reset Link
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
