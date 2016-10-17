@extends('layouts.default')

@section('title', 'View Cart')

@section('content')

<div class="row">
	<div class="card">
		<div class="card-title">Cart</div>
		<div class="card-content">
			@if($cart == false)
				<p>Nothing in your cart!</p>
			@else
				@foreach($cart->members as $product)
					<p>{{$product->name}} at ${{$product->price}}</p>
				@endforeach
			@endif
		</div>
	</div>
</div>

@endsection