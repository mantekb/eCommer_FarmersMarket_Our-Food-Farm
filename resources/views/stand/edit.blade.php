@extends('layouts.default')

@section('title', 'Settings')

@section('content')

<h2>Edit Your Stand</h2>
<form class="form-horizontal" id="editStand" role="form" method="POST" action="{{ url('/stand/edit') }}">
    <div class="card">
        <div class="card-content">
            <div class="card-title">Stand Name</div>
                {{ csrf_field() }}

                <div class="input-field">
                    <label for="name">Name</label>

                    <input id="name" type="text" class="form-control" name="name" value="{{$stand->name}}">
                </div>
        </div>

        <div class="card-content">
        	<div class="card-title">Stand Description</div>
                {{ csrf_field() }}

                <div class="input-field">
                    <label for="description">Description</label>

                    <textarea id="description" type="text" class="materialize-textarea" name="description">{{$stand->description}}</textarea>
                </div>
        </div>

        <div class="card-content">
    	   <div class="card-title">Stand Address</div>
                {{ csrf_field() }}
                <div class="input-field">
                    <label for="address">Address</label>

                    <input id="address" type="text" class="form-control" name="address" value="{{$stand->address->address}}">

                </div>

                <div class="input-field">
                    <label for="city">City</label>

                    <input id="city" type="text" class="form-control" name="city" value="{{$stand->address->city}}">

                </div>

                <div class="input-field">
                    <label for="state">State</label>

                    <input id="state" type="text" class="form-control" name="state" value="{{$stand->address->state}}">

                </div>

                <div class="input-field">
                    <label for="zip">ZIP</label>

                    <input id="zip" type="text" class="form-control" name="zip" value="{{$stand->address->zip}}">

                </div>
        </div>

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