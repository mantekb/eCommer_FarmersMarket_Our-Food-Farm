<head>
    <title>@yield('title')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="_token" content="{{ csrf_token() }}">
	
    {{-- Materializecss.com --}}
	<!-- Compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css">

	{{-- MapBox css --}}
	<link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.23.0/mapbox-gl.css' rel='stylesheet' />
	
	{{-- SweetAlert --}}
	<link rel="stylesheet" href="{{asset('css/sweetalert.css')}}">

	<style type="text/css">
		
	</style>

	{{-- Stand css --}}
	<link rel="stylesheet" href="{{asset('css/stand.css')}}">

	{{-- Main css --}}
	<link rel="stylesheet" href="{{asset('css/main.css')}}">

	{{-- Landing css --}}
	<link rel="stylesheet" href="{{asset('css/landing.css')}}">

	{{-- Material icons --}}
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">       

</head>