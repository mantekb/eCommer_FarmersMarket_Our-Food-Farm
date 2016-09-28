<head>
    <title>@yield('title')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="_token" content="{{ csrf_token() }}">
	
    {{-- Materializecss.com --}}
	<!-- Compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css">
	
	{{-- SweetAlert --}}
	<link rel="stylesheet" href="{{asset('css/sweetalert.css')}}">

	{{-- Stand css --}}
	<link rel="stylesheet" href="{{asset('css/stand.css')}}">

	{{-- Material icons --}}
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">       

</head>