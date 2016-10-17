@extends('layouts.default')

@section('title', 'OurFoodFarm')

@section('content')

<input style="width: 60%;" type="text" placeholder="Zip Code" id="zipcode">
<button id="find" class="btn btn-primary col s6">Find Me</button>

{{-- <div class="text-center">Map goes here.</div> --}}

<div id='map' style='width: 100%; height: 450px;'></div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyARhc7qq_OMKMSgQ-ONkvAxAiNmk_yf5tw"></script>
@endsection