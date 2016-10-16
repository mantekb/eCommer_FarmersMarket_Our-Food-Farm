@extends('layouts.default')

@section('title', 'Your Products')

@section('content')

<div class="row">
	<div class="col s12">
		<h3 class="center-align">Add and Edit Products for '{{$stand->name}}'</h3>
	</div>
</div>

{{-- First offer input for adding new products. --}}
<div class="row">
	<div class="card">
		<div class="card-content">
			<span class="card-title">New Product</span>
			<form method="POST" action="{{url('/stand/products')}}">
				{{ csrf_field() }}
				<div class="input-group">
					<label for="name">Name</label>
					<input id="name" name="name" type="text">
				</div>
				<div class="input-group">
					<label for="description">Description</label>
					<input id="description" name="description" type="text">
				</div>
				<div class="input-group">
					<label for="price">Price</label>
					<input id="price" name="price" type="text">
				</div>
				<div class="input-group">
					<label for="stock">Stock</label>
					<input id="stock" name="stock" type="number">
				</div>
				<input type="hidden" name="type" value="new">
				<button class="btn btn-primary" type="submit" id="submitCreateProduct">Create Product</button>
			</form>
		</div>
	</div>
</div>

{{-- Next show all existing products, and be able to delete and edit them. --}}
<div class="row" id="products">
	@foreach($stand->products as $product)
		@include('stand.product-card', ['product' => $product, 'edit' => true])
	@endforeach
</div>

@endsection