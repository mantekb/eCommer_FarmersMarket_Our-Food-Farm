@extends('layouts.default')

@section('title', 'Settings')

@section('content')

<h2>Change Your Settings</h2>

<h5>Name:</h5>
<input style="width: 60%;" type="text" placeholder="New Name" id="name">
<button id="name_change" class="btn btn-primary col s6">Change</button>

<h5>Password:</h5>
<input style="width: 60%;" type="text" placeholder="New Password" id="pass">
<input style="width: 60%;" type="text" placeholder="Confirm Password" id="pass_conf">
<button id="pass_change" class="btn btn-primary col s6">Change</button>

<h5>Address:</h5>
<input style="width: 60%;" type="text" placeholder="Address Ln 1" id="line_1">
<input style="width: 60%;" type="text" placeholder="Address Ln 2" id="line_2">
<input style="width: 60%;" type="text" placeholder="City" id="city">
<input style="width: 60%;" type="text" placeholder="State" id="state">
<input style="width: 60%;" type="text" placeholder="ZIP" id="zip">
<button id="address_change" class="btn btn-primary col s6">Change</button>

<h5>Your Stand</h5>
<button id="stand_remove" class="btn btn-primary col s6">Remove</button>

@endsection