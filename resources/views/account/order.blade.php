@extends('layouts.default')

@section('title', 'Order')

@section('content')

<div class="card">
	<div class="card-content">
		<span class="card-title">Order For {{$order->created_at}}</span>
		<table>
			<thead>
				<tr>
					<th>Product Name</th>
					<th>Quantity</th>
					<th>Price</th>
				</tr>
			</thead>
			<tbody>
				@foreach($items as $product)
					<tr>
						<td>{{$product->name}}</td>
						<td>{{$product->quantity}}</td>
						<td>{{$product->price}}</td>
					</tr>
				@endforeach
				<tr>
					<td>Total Quantity:</td>
					<td colspan="2">{{$order->getTotalQuantity()}}</td>
				</tr>
				<tr>
					<td colspan="2">Total Price:</td>
					<td>{{$order->getTotalPrice()}}</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>

@endsection