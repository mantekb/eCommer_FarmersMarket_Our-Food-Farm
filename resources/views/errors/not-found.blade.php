@extends('layouts.default')

@section('title', '404')

@section('content')

<div class="row">
	<div class="col s12">
		<h1 class="center-align">404 Error</h1>
	</div>
</div>

<div class="row">
	<div class="card">
		<div class="card-content">
			<span class="card-title">This page does not exist.</span>
			<p>Please try navigating to a different page.</p>
			{{-- We can use this if we have this be 404.blade.php --}}
			{{-- the reason it's not is because there's no token on the 404 page by laravel --}}
			{{-- So the login form will NOT work correctly. --}}
			{{-- <p>Error: 
			{{$exception->getMessage()}}</p> --}}
			<br />
			<a href="{{url('/home')}}" class="btn btn-primary">Go Home</a>
		</div>
	</div>
</div>

@endsection