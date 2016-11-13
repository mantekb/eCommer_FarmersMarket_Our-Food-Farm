@extends('layouts.default')

@section('title', 'Checkout')

@section('content')

{{-- <div class="row">
	<div class="col s12">
		<h1 class="center-align">Choose A Payment Method</h1>
	</div>
</div> --}}

<div class="row">
	<div class="card">
		<div class="card-content">
			<span class="card-title">Choose A Payment Method To Proceed</span>
			<form>
				{{-- This only shows if payment info is saved. --}}
				@if(!empty($paymentInfo))
				<p>
					<input class="with-gap" name="paymentGroup" type="radio" id="savedCC" checked="checked">
					<label for="savedCC">Use Card Ending In *{{$paymentInfo->lastFour}}</label>
				</p>
				@else
				<p>
					<a href="{{url('/payment')}}">Click This Link To Go Save Your Payment Info</a>
					<br><br>
				</p>
				@endif
				<p>
					<input class="with-gap" name="paymentGroup" type="radio" id="payCash">
					<label for="payCash">Pay In Cash</label>
				</p>
				<p>
					<input class="with-gap" name="paymentGroup" type="radio" id="payCard">
					<label for="payCard">Use A Card</label>
				</p>
			</form>
		</div>
	</div>
</div>

@endsection