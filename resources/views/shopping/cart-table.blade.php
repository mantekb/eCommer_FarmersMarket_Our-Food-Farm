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
				<td><span class="quantity">
				@if($view)
					<input type="number" id="quant_input-{{$product->id}}" min="1" 
					data-orig-quant="{{$product->quantity}}" value="{{$product->quantity}}" >
				@else
					{{$product->quantity}}
				@endif
				</span></td>
				<td><span class="price">{{$product->price}}</span></td>
				@if($view)
					<td><a class="btn red remove-product" id="rm-{{$product->id}}">X</a></td>
				@endif
			</tr>
		@endforeach
		<tr>
			<td colspan="2">Subtotal:</td>
			<td>(<span class="totalQuantity">{{ $cart->getTotalQuantity() }}</span> items)</td>
			<td><span class="totalPrice">{{ $cart->getTotalPrice() }}</span></td>
			@if($view)
				<td></td>
			@endif
		</tr>
	</tbody>
</table>