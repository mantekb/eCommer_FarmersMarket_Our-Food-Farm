<?php 
// $view denotes whether or not this is the view-cart page
if (!isset($view))
{
	$view = false;
}
?>
<table class="cart striped">
	<thead>
		<tr>
			<th>Image</th>
			<th>Name</th>
			<th>Quantity</th>
			<th>Price</th>
			@if($view)
				<th>Remove</th>
			@endif
		</tr>
	</thead>
	<tbody>
		@foreach($cart->members as $product)
			<tr>
				<td><img src="{{asset("img/tomato.jpg")}}" alt=""></td>
				<td><span class="name">{{$product->name}}</span></td>
				<td><span class="quantity">{{$product->quantity}}</span></td>
				<td><span class="price">{{$product->price}}</span></td>
				@if($view)
					<td><a class="btn red remove-product" id="rm-{{$product->id}}">X</a></td>
				@endif
			</tr>
		@endforeach
		<tr>
			<td colspan="2">Subtotal:</td>
			<td>({{ $cart->getTotalQuantity() }} items)</td>
			<td>{{ $cart->getTotalPrice() }}</td>
			@if($view)
				<td></td>
			@endif
		</tr>
	</tbody>
</table>