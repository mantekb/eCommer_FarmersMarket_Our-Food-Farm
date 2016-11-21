@extends('layouts.default')

@section('title', 'Settings')

@section('content')

<h2>Edit Your Stand</h2>
<div class="card">
    <div class="card-content">
        <div class="card-title">Stand Name</div>
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/stand/edit/name') }}">
            {{ csrf_field() }}

            <div class="input-field">
                <label for="name">Name</label>

                <input id="name" type="text" class="form-control" name="name" value="{{$stand->name}}">
            </div>

            <div class="input-field">
                <button type="submit" id="changeStandName" class="btn btn-primary">
                	Change Name
                </button>
            </div>
        </form>
    </div>
</div>

<div class="card">
	<div class="card-content">
		<div class="card-title">Stand Description</div>
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/stand/edit/description') }}">
            {{ csrf_field() }}

            <div class="input-field">
                <label for="description">Description</label>

                <textarea id="description" type="text" class="materialize-textarea" name="description">{{$stand->description}}</textarea>
            </div>

            <div class="input-field">
                <button type="submit" id="changeStandPassword" class="btn btn-primary">
                	Change Password
                </button>
            </div>
        </form>
    </div>
</div>

<div class="card">
	<div class="card-content">
		<div class="card-title">Stand Address</div>
        <form class="form-horizontal" role="form" id="editStandAddress" method="POST" action="{{ url('/stand/edit/address') }}">
            {{ csrf_field() }}
            <div class="input-field">
                <label for="address">Address</label>

                <input id="address" type="text" class="form-control" name="address" value="{{$address->address}}">

            </div>

            <div class="input-field">
                <label for="city">City</label>

                <input id="city" type="text" class="form-control" name="city" value="{{$address->city}}">

            </div>

            <div class="input-field">
                <label for="state">State</label>

                <input id="state" type="text" class="form-control" name="state" value="{{$address->state}}">

            </div>

            <div class="input-field">
                <label for="zip">ZIP</label>

                <input id="zip" type="text" class="form-control" name="zip" value="{{$address->zip}}">

            </div>

            <div class="input-field">
                <button type="submit" id="changeStandAddress" class="btn btn-primary">
	                Change Address
                </button>
            </div>
        </form>
    </div>
</div>

<div class="card">
	<div class="card-content">
		<div class="card-title">Remove Your Stand</div>
        <button type="button" class="btn btn-primary" onclick="removeStand();">
            Remove Your Stand
        </button>
	</div>
</div>

@endsection