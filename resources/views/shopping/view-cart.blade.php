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
		<div id="cart-table">
			@include('shopping.cart-table', ['cart' => $cart, 'view' => true])
		</div>
	@endif
</div>

<div class="row">
	<div class="col s12 m5">
		<button data-link="{{url('/checkout')}}" class="btn btn-success" id="checkoutBtn">Proceed To Checkout</button>
	</div>
	<div class="col s12 m5" id="updateCartForm" style="display:none;">
		<button class="btn btn-warning" id="updateCartBtn">Update Cart</button>
	</div>
</div>

@endsection