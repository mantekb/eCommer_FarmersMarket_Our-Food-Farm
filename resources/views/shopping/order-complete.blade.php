@extends('layouts.default')

@section('title', 'Order Completed')

@section('content')

<div class="card">
	<div class="card-content">
		<span class="card-title">Order Summary</span>
		<p>Make sure to pick up your order from the stands below.</p>
	</div>
</div>

@foreach($stands as $stand)

	<div class="row stand-address">

		@include('stand.stand-address', ['stand' => $stand['stand']])
	    
	</div>

	<div class="grid row">
        @foreach($stand['products'] as $product)
            @include('stand.product-card', ['product' => $product, 'toPickup' => $product->quantity])
        @endforeach
    </div>

@endforeach

@endsection