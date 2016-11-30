@extends('layouts.default')

@section('title', 'Stand Settings')

@section('content')

<h2>Edit Your Stand</h2>
<form class="form-horizontal" id="editStand" role="form" method="POST" action="{{ url('/stand/edit') }}">
    <div class="card">
        <div class="card-content">
            <div class="card-title">Stand Name</div>
                {{ csrf_field() }}

                <div class="input-field{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name">Name</label>

                    <input id="name" type="text" class="form-control" name="name" value="{{$errors->has('name') ? old('name') : $stand->name}}">

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
        </div>

        <div class="card-content">
        	<div class="card-title">Stand Description</div>
                {{ csrf_field() }}

                <div class="input-field{{ $errors->has('description') ? ' has-error' : '' }}">
                    <label for="description">Description</label>

                    <textarea id="description" type="text" class="materialize-textarea" name="description">{{$stand->description}}</textarea>

                    @if ($errors->has('description'))
                        <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>
        </div>

        <div class="card-content">
    	   <div class="card-title">Stand Address</div>
                {{ csrf_field() }}
                <div class="input-field{{ $errors->has('address') ? ' has-error' : '' }}">
                    <label for="address">Address</label>

                    <input id="address" type="text" class="form-control" name="address" value="{{$stand->address->address}}">

                    @if ($errors->has('address'))
                        <span class="help-block">
                            <strong>{{ $errors->first('address') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="input-field{{ $errors->has('city') ? ' has-error' : '' }}">
                    <label for="city">City</label>

                    <input id="city" type="text" class="form-control" name="city" value="{{$stand->address->city}}">

                    @if ($errors->has('city'))
                        <span class="help-block">
                            <strong>{{ $errors->first('city') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="input-field{{ $errors->has('state') ? ' has-error' : '' }}">
                    <label for="state">State</label>

                    <input id="state" type="text" class="form-control" name="state" value="{{$stand->address->state}}">

                    @if ($errors->has('state'))
                        <span class="help-block">
                            <strong>{{ $errors->first('state') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="input-field{{ $errors->has('zip') ? ' has-error' : '' }}">
                    <label for="zip">ZIP</label>

                    <input id="zip" type="text" class="form-control" name="zip" value="{{$stand->address->zip}}">

                    @if ($errors->has('zip'))
                        <span class="help-block">
                            <strong>{{ $errors->first('zip') }}</strong>
                        </span>
                    @endif
                </div>
        </div>

        {{-- Hidden inputs for lat and long --}}
        <input type="hidden" id="lat" name="lat">
        <input type="hidden" id="long" name="long">

        <div class="card-content">
            <button type="submit" id="submitEditStand" class="btn btn-primary">
                Submit
            </button>
        </div>
    </div>
</form>

<div class="card">
	<div class="card-content">
		<div class="card-title">Remove Your Stand</div>
        <button type="button" class="btn btn-primary" onclick="removeStand();">
            Remove Your Stand
        </button>
	</div>
</div>

@endsection