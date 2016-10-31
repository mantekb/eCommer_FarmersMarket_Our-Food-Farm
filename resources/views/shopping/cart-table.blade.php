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
			<td colspan="2">Subtotal:</td>
			<td>({{ $cart->getTotalQuantity() }} items)</td>
			<td>{{ $cart->getTotalPrice() }}</td>
		</tr>
	</tbody>
</table>