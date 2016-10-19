@extends('layouts.default')

@section('title', 'OurFoodFarm')

@section('content')

@if(Auth::user())
	@if (Auth::user()->address)
		<?php $address = Auth::user()->address; ?>
		{{-- We should already have the lat and long for the user. --}}
		{{-- <input type="hidden" id="user-address" value="{{$address->address or ''}}"> --}}
		{{-- <input type="hidden" id="user-city" value="{{$address->city or ''}}"> --}}
		{{-- <input type="hidden" id="user-state" value="{{$address->state or ''}}"> --}}
		{{-- <input type="hidden" id="user-zip" value="{{$address->zip or ''}}"> --}}
		<input type="hidden" id="user-lat" value="{{$address->lat or ''}}">
		<input type="hidden" id="user-long" value="{{$address->long or ''}}">
	@endif
@endif

<input style="width: 60%;" type="text" placeholder="Zip Code" id="zipcode">
<button id="find" class="btn btn-primary col s6">Find Me</button>

{{-- <div class="text-center">Map goes here.</div> --}}

<div id='map' style='width: 100%; height: 450px;'></div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyARhc7qq_OMKMSgQ-ONkvAxAiNmk_yf5tw"></script>
@endsection