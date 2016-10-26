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

<div class="row">
	@if($cart == false)
		<h5>Nothing in your cart!</h5>
	@else
		<table class="cart striped">
			<thead>
				<tr>
					<th>Image</th>
					<th>Name</th>
					<th>Price</th>
					<th>Quantity</th>
				</tr>
			</thead>
			<tbody>
				@foreach($cart->members as $product)
					<tr>
						<td><img src="{{asset("img/tomato.jpg")}}" alt=""></td>
						<td><span class="name">{{$product->name}}</span></td>
						<td><span class="price">{{$product->price}}</span></td>
						<td><span class="quantity">{{$product->quantity}}</span></td>
					</tr>
				@endforeach
			</tbody>
		</table>
	@endif
</div>

@endsection