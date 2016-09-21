@extends('layouts.default')

@section('title', 'OurFoodFarm')

@section('content')

<input style="width: 60%;" type="text" placeholder="Zip Code" id="zipcode">
<button id="find" class="btn btn-primary col s6">Find Me</button>

{{-- <div class="text-center">Map goes here.</div> --}}

<div id='map' style='width: 100%; height: 450px;'></div>
<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.23.0/mapbox-gl.js'></script>
<link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.23.0/mapbox-gl.css' rel='stylesheet' />
<script>
// My personal accessToken, do not keep
mapboxgl.accessToken = 'pk.eyJ1IjoiaW5zYW5lYWxlYyIsImEiOiJjaXN0Y3VtMDIwM2szMnpsOGFyNzBranpiIn0.t73_pX_gZy5govr5LM9liA';
var map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/streets-v9'
});
</script>

@endsection