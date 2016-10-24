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
	</div>
</div>

{{-- Needs more work, this is good for dropdown, but not for viewcart page. --}}
<div class="row">
	<div class="cart">
		@if($cart == false)
			<p>Nothing in your cart!</p>
		@else
			<div class="cart-item head">
				<div class="col s1 m2">
					<p>Image</p>
				</div>
				<div class="col s1 m2">
					<p>Name</p>
				</div>
				<div class="col s1 m2">
					<p>Price</p>
				</div>
				<div class="col s1 m2">
					<p>Quantity</p>
				</div>
			</div>
			@foreach($cart->members as $product)
			<div class="cart-item">
				<div class="col s1 m2">
					<img src="{{asset("img/tomato.jpg")}}" alt="">
				</div>
				<div class="col s1 m2">
					<h6 class="name">{{$product->name}}</h6>
				</div>
				<div class="col s1 m2">
					<p class="price">{{$product->price}}</p>
				</div>
				<div class="col s1 m2">
					<p class="quantity">{{$product->quantity}}</p>
				</div>
			</div>
			@endforeach
		@endif
	</div>
</div>

@endsection