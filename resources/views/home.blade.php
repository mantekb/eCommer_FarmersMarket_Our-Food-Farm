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
<div class="container-fluid">
	<div id="searchbar" class="row">
		<div id="zip-section" class="col-md-3">
			<span id="zip-text">Searching near </span><span id="zip">{{-- zip code will be inserted here --}}</span>
			<button id="change-zip" class="zip-dropdown-items">Change Location</button>
		</div>
		<div id="search-section" class="col-md-5">
			<input type="text" id="search-input" placeholder="Enter an item or stand">
			<button id="search-button">
	    		<img class="search-icon" src='{{asset("img/search.png")}}' alt='[]' />
	    	</button>
	    </div>
	    <div id="filters" class="col-md-4">
	    </div>
	</div>
	<div id="zip-dropdown" class="zip-dropdown-items hide">
	    <input type="text" class="zip-dropdown-items" id="zip-input">
	    <button id="zip-search">
	    	<img class="search-icon" src='{{asset("img/search.png")}}' alt='[]' />
	    </button>
	</div>
</div>
<div id='map' style='width: 100%; height: 450px;'></div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyARhc7qq_OMKMSgQ-ONkvAxAiNmk_yf5tw"></script>
@endsection