@extends('layouts.default')

@section('title', 'View Cart')

@section('content')

<div class="row">
	<div class="col s12">
		<h1 class="center-align">Cart</h1>
		<h3 class="center-align">Scroll to the bottom to move on to checkout.</h3>
	</div>
</div>

<div class="row">
	@if($cart == false)
		<h5>Nothing in your cart!</h5>
	@else
		@include('shopping.cart-table', ['cart' => $cart])
	@endif
</div>

@endsection