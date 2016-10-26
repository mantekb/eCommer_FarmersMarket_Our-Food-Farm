@extends('layouts.default')

@section('title', 'View Cart')

@section('content')

{{-- <div class="row">
	<div class="card">
		<div class="card-title">Cart</div>
		<div class="card-content">
			@if($cart == false)
				<p>Nothing in your cart!</p>
			@else
				@foreach($cart->members as $product)
					<p>{{$product->name}} at ${{$product->price}} quantity: {{$product->quantity}}</p>
				@endforeach
			@endif
		</div>
	</div>
</div> --}}

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
		<table class="cart striped">
			<thead>
				<tr>
					<th>Image</th>
					<th>Name</th>
					<th>Quantity</th>
					<th>Price</th>
				</tr>
			</thead>
			<tbody>
				@foreach($cart->members as $product)
					<tr>
						<td><img src="{{asset("img/tomato.jpg")}}" alt=""></td>
						<td><span class="name">{{$product->name}}</span></td>
						<td><span class="quantity">{{$product->quantity}}</span></td>
						<td><span class="price">{{$product->price}}</span></td>
					</tr>
				@endforeach
				<tr>
					<td colspan="3">Total Quantity:</td>
					<td>{{-- $cart->getTotalQuantity() --}}</td>
				</tr>
				<tr>
					<td colspan="3">Total Price:</td>
					<td>{{-- $cart->getTotalPrice() --}}</td>
				</tr>
			</tbody>
		</table>
	@endif
</div>

@endsection