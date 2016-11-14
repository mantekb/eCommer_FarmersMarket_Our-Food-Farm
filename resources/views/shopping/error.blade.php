@extends('layouts.default')

@section('title', 'Error')

@section('content')

<div class="row">
	<div class="col s12">
		<h1 class="center-align">Checkout Error</h1>
	</div>
</div>

<div class="row">
	<div class="card">
		<div class="card-content">
			<span class="card-title">{{$title}}</span>
			<p>{{$message}}</p>
		</div>
		<div class="card-action"><a href="{{url($link)}}">{{$btn}}</a></div>
	</div>
</div>

@endsection