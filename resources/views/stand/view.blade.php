@extends('layouts.default')

@section('title', $stand->name)

@section('content')

<div class="row">
    <div class="col s12">
        <h1 class="center-align">{{$stand->name}}</h1>
    </div>
</div>

<div class="left">
    <div id='map' style='width: 250px; height: 250px; border: solid 1px;'>Map</div>
</div>

<div class="row">
    <div class="col s8 m5 push-m1 l5 push-l2">
        <p class="center-align">{{$stand->description}}</p>
    </div>
    <br>
    <div class="col s8 m5 push-m1 l5 push-l2">
        <p class="center-align">
            {{$stand->address}}<br>
            {{$stand->city}}, {{$stand->state}} {{$stand->zip}}
        </p>
    </div>
</div>

{{-- Here display cards of the items for sale --}}
<div class="row">
    @for($i = 0; $i < 3; $i++)
    <div class="col s12 m4">
        <div class="card">
            <div class="card-image"><img src="http://feelgrafix.com/data_images/out/27/956607-tomato.jpg" alt=""><span class="card-title blue-text">Tomato</span></div>
            <div class="card-content">
                <p>Buy this</p>
            </div>
            <div class="card-action"><a href="">Add To Cart</a></div>
        </div>
    </div>
    @endfor
</div>


{{-- Here display reviews of this stand --}}


@endsection
