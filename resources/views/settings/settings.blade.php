@extends('layouts.default')

@section('title', 'Settings')

@section('content')

<h2>Settings</h2>
<div class="card">
    <div class="card-content">
        <div class="card-title">Change Your Name</div>
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/settings/name') }}">
            {{ csrf_field() }}

            <div class="input-field">
                <label for="name">Name</label>

                <input id="name" type="text" class="form-control" name="name">
            </div>

            <div class="input-field">
                <button type="submit" id="changeName" class="btn btn-primary">
                	Change Name
                </button>
            </div>
        </form>
    </div>
</div>

<div class="card">
	<div class="card-content">
		<div class="card-title">Reset Your Password</div>
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/settings/password') }}">
            <div class="input-field">
                <label for="new_password">New Password</label>

                <input id="new_password" type="password" class="form-control" name="new_password">

            </div>

            <div class="input-field">
                <label for="conf_password">Confirm Password</label>

                <input id="conf_password" type="password" class="form-control" name="conf_password">

            </div>

            <div class="input-field">
                <button type="submit" id="changePassword" class="btn btn-primary">
                	Change Password
                </button>
            </div>
        </form>
    </div>
</div>

<div class="card">
	<div class="card-content">
		<div class="card-title">Change Your Address</div>
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/settings/address') }}">
            <div class="input-field">
                <label for="address">Address</label>

                <input id="address" type="text" class="form-control" name="address">


            </div>

            <div class="input-field">
                <label for="city">City</label>

                <input id="city" type="text" class="form-control" name="city">

            </div>

            <div class="input-field">
                <label for="state">State</label>

                <input id="state" type="text" class="form-control" name="state">

            </div>

            <div class="input-field">
                <label for="zip">ZIP</label>

                <input id="zip" type="text" class="form-control" name="zip">

            </div>

            <div class="input-field">
                <button type="submit" class="btn btn-primary">
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