@extends('layouts.default')

@section('title', $stand->name)

@section('content')

<div class="row">
    <div class="col s12">
        <h1 class="center-align">{{$stand->name}}</h1>
    </div>
</div>


<div class="row">

    <div class="map col m6 l4">
        <div id="standMap" style='width: 250px; height: 250px; border: solid 1px;'>Map</div>
    </div>

    <div class="col s8 push-s2 m5 l5 push-l1">
        <p class="center-align">{{$stand->description}}</p>
    </div>
    <br>
    <div class="col s8 push-s2 m5 l5 push-l1">
        <p class="center-align">
            {{$stand->address}}<br>
            {{$stand->city}}, {{$stand->state}} {{$stand->zip}}
        </p>
    </div>
</div>

{{-- Placeholders below --}}
<div class="row">
    <div class="col s12">
        <h5>Items Currently For Sale:</h5>
    </div>
</div>

<div class="row">
    @for($i = 0; $i < 3; $i++)
    <div class="col s8 push-s2 m4 l3">
        <div class="card">
            <div class="card-image">
                <img src="http://feelgrafix.com/data_images/out/27/956607-tomato.jpg" alt="">
                <span class="card-title blue-text">Tomato</span>
            </div>
            <div class="card-content">
                <p>Buy this</p>
            </div>
            <div class="card-action"><a href="">Add To Cart</a></div>
        </div>
    </div>
    @endfor
</div>


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
