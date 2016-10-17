@extends('layouts.default')

@section('title', $stand->name)

@section('content')

<div class="row">
    <div class="col s12">
        <h1 class="center-align" id="standName">{{$stand->name}}</h1>
    </div>
</div>


<div class="row stand-address">

    {{-- hidden --}}
    <input type="hidden" id="lat" value="{{$stand->address->lat}}">
    <input type="hidden" id="long" value="{{$stand->address->long}}">
    <div class="map col m6 l4">
        <div id="standMap" style='width: 250px; height: 250px; border: solid 1px;'></div>
    </div>

    <div class="col s8 push-s2 m5 l5 push-l1">
        <p class="center-align">{{$stand->description}}</p>
    </div>
    <br>
    <div class="col s8 push-s2 m5 l5 push-l1">
        <p class="center-align">
            {{$stand->address->address}}<br>
            {{$stand->address->city}}, {{$stand->address->state}} {{$stand->address->zip}}
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
        @include('stand.product-card')
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
