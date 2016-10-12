@extends('layouts.default')

@section('title', 'Your Products')

@section('content')

<div class="row">
	<div class="col s12">
		<h3 class="center-align">Add and Edit Products for '{{$stand->name}}'</h3>
	</div>
</div>

{{-- First offer input for adding new products. --}}

{{-- Next show all existing products, and be able to delete and edit them. --}}

@endsection