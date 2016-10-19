@extends('layouts.default')

@section('title', 'OurFoodFarm')

@section('content')

<div class="marquee">
	<div class="search">
		<label for="zipcode" id="ziplabel">Find fresh food near you</label>
			<input id="zipcode" name="zipcode" class="zip" type="text" placeholder="Enter your zipcode"/>
			<button id="find" class="landing" onclick="location.href='{{url('/home')}}?zip='+$('#zipcode').val();">
				<img class="icon" src='{{asset("img/search.png")}}' alt='[]' />
			</button>
	</div>
    <img src='{{asset("img/landing.jpg")}}' style='width:100%;height:100%' alt='[]' />
</div>
@endsection