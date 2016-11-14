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

			<div class="card">
				<div class="card-content">
					<span class="card-title">Please Note:</span>
					<p>This WILL submit your card for payment if that is the option chosen.</p>
					<p>Go to <a href="{{url('/cart/view')}}">Review Order</a> to make sure your order is correct.</p>
				</div>
			</div>

			<form method="POST" action="{{url('/checkout/pay')}}" id="checkoutPayment">
				{{ csrf_field() }}

				{{-- This only shows if payment info is saved. --}}
				@if(!empty($paymentInfo))
				<p>
					<input class="with-gap" name="paymentGroup" type="radio" id="savedCC" checked="checked">
					<label for="savedCC">Use Card Ending In *{{$paymentInfo->last_four}}</label>
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

				<div id="ccForm" style="display: none;">
					<div class="input-field">
						<label for="ccNum">Credit/Debit Card Number</label>
						<input type="number" class="form-control" name="ccNum" id="ccNum">
					</div>
					<div class="input-field">
						<label for="ccCVC">CVC Number</label>
						<input type="number" class="form-control" name="ccCVC" id="ccCVC">
					</div>
					<div class="input-field">
						<label for="ccMonth">Expiration Month</label>
						<input type="number" class="form-control" name="ccMonth" id="ccMonth">
					</div>
					<div class="input-field">
						<label for="ccYear">Expiration Year</label>
						<input type="number" class="form-control" name="ccYear" id="ccYear">
					</div>
				</div>

				{{-- This is used so the backend can more easily determine how to bill. --}}
				<input hidden value="" type="text" name="payType" id="payType">

				<br>
				<button id="submitCheckoutPaymentForm" type="submit" class="btn btn-success">Checkout</button>
			</form>

		</div>
	</div>
</div>

@endsection