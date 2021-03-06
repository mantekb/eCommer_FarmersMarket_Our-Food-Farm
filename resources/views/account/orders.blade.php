@extends('layouts.default')

@section('title', 'Orders')

@section('content')

@if(empty($orders))
	<div class="row">
	    <div class="col s12">
	        <h1 class="center-align">You haven't made any orders.</h1>
	        <a href="{{url('/home')}}" class="btn btn-primary">Find Some Food</a>
	    </div>
	</div>
@else
	<div class="card">
		<div class="card-content">
			<table>
				<thead>
					<tr>
						<th>Ordered On</th>
						<th>Paid With</th>
					</tr>
				</thead>
				<tbody>
					@foreach($orders as $order)
						<tr>
							<td><a href="{{url("/order/".$order->id)}}">
								{{$order->created_at}}
							</a></td>
							<td>{{$order->paid_with}}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endif

@endsection