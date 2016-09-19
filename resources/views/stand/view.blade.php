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



@endsection
