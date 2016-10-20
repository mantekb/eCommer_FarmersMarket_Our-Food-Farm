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

{{-- Modal for editing a product --}}
<div id="edit_product_modal" class="modal">
    <div class="modal-content">
        <h4>Edit Your Product</h4>
        <div class="input-field">
            <label for="edit_product_name">Name</label>
            <input type="text" class="form-control" id="edit_product_name">
        </div>
        <div class="input-field">
            <label for="edit_product_description">Description</label>
            <input type="text" class="form-control" id="edit_product_description">
        </div>
        <div class="input-field">
            <label for="edit_product_stock">Stock</label>
            <input type="number" class="form-control" id="edit_product_stock">
        </div>
        <div class="input-field">
            <label for="edit_product_price">Price</label>
            <input type="text" class="form-control" id="edit_product_price">
        </div>
    </div>
    <div class="modal-footer">
        <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
    </div>
</div>

@endsection