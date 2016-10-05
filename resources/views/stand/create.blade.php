@extends('layouts.default')

@section('title', 'Create Stand')

@section('content')
<div class="col m8 push-m2">
    <div class="card">
        <div class="card-content">
            <div class="card-title">Create Your Food Stand</div>
            <form class="form-horizontal" id="createStand" role="form" method="POST" action="{{ url('/stand/create') }}">
                {{ csrf_field() }}

                <div class="input-field{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name">Name</label>

                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="input-field{{ $errors->has('description') ? ' has-error' : '' }}">
                    <label for="description">Description</label>

                    {{-- Make this a text area --}}
                    <textarea id="description" type="text" class="materialize-textarea" name="description"></textarea>

                    @if ($errors->has('description'))
                        <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="input-field{{ $errors->has('address') ? ' has-error' : '' }}">
                    <label for="address">Address</label>

                    {{-- Make this a text area --}}
                    <input id="address" type="text" class="form-control" name="address">

                    @if ($errors->has('address'))
                        <span class="help-block">
                            <strong>{{ $errors->first('address') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="input-field{{ $errors->has('city') ? ' has-error' : '' }}">
                    <label for="city">City</label>

                    {{-- Make this a text area --}}
                    <input id="city" type="text" class="form-control" name="city">

                    @if ($errors->has('city'))
                        <span class="help-block">
                            <strong>{{ $errors->first('city') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="input-field{{ $errors->has('state') ? ' has-error' : '' }}">
                    <label for="state">State</label>

                    {{-- Make this a text area --}}
                    <input id="state" type="text" class="form-control" name="state">

                    @if ($errors->has('state'))
                        <span class="help-block">
                            <strong>{{ $errors->first('state') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="input-field{{ $errors->has('zip') ? ' has-error' : '' }}">
                    <label for="zip">Zip</label>

                    {{-- Make this a text area --}}
                    <input id="zip" type="text" class="form-control" name="zip">

                    @if ($errors->has('zip'))
                        <span class="help-block">
                            <strong>{{ $errors->first('zip') }}</strong>
                        </span>
                    @endif
                </div>

                {{-- Hidden inputs for lat and long --}}
                <input type="hidden" id="lat">
                <input type="hidden" id="long">

                <div class="input-field">
                    <div class="col m6 push-m4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-btn fa-sign-in"></i> Create
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
