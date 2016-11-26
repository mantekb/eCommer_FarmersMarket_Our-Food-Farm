@extends('layouts.default')

@section('title', $stand->name)

@section('content')

<div class="row">
    <div class="col s12">
        <h1 class="center-align">{{$stand->name}}</h1>
    </div>
</div>

@if(Auth::user() && Auth::user()->id == $stand->user_id)
    <div class="row" align="right">
        <button id="edit" class="btn btn-primary" onclick="location.href=DOCUMENT_ROOT+'/stand/edit';">Edit Your Stand</button>
    </div>
@endif

<div class="row stand-address">

	@include('stand.stand-address', ['stand' => $stand])
    
</div>

{{-- Only show products if they exist. --}}
@if(isset($products) && count($products) > 0)
    <div class="row">
        <div class="col s12">
            <h3>Items Currently For Sale:</h3>
        </div>
    </div>

    <div class="row">
        @foreach($products as $product)
            @include('stand.product-card', ['product' => $product])
        @endforeach
    </div>
@endif


<div class="row">
    <div class="col s12">
        <h5>Reviews: ★★★☆☆</h5>
    </div>
</div>

<div class="row">
    @for($j = 0; $j < 3; $j++)
    <div class="col s12">
        <div class="card">
            <div class="card-content">
                <span class="card-title">
                    This Food Rocked!!
                    <span class="right">★★★☆☆</span>
                </span>
                <p>
                    asldjfwaoiejfwjfsdoijfsijfwioejfweojfoijd kjasofjsljfsoafjskjfsjfslajfsofjewlfjojf
                </p>
            </div>
            <div class="card-action">
                <a href="">Read More</a>
                <a href="" class="right">Author Name</a>
            </div>
        </div>
    </div>
    @endfor
</div>


@endsection
