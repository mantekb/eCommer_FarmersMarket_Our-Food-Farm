<head>
    <title>@yield('title')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="_token" content="{{ csrf_token() }}">
	
    {{-- Materializecss.com --}}
	<!-- Compiled and minified CSS -->
	<link rel="stylesheet" href="{{asset('css/materialize.min.css')}}">

	{{-- MapBox css --}}
	<link rel="stylesheet" href="{{asset('css/mapbox-gl.css')}}">
	
	{{-- SweetAlert --}}
	<link rel="stylesheet" href="{{asset('css/sweetalert.css')}}">

	<style type="text/css">
		@font-face {
		    font-family: LandDownUnder;
		    src: url('{{asset("fonts/land_downunder/land downunder.eot?#iefix")}}') format('embedded-opentype'), 
		         url('{{asset("fonts/land_downunder/land downunder.woff")}}') format('woff'), 
		         url('{{asset("fonts/land_downunder/land downunder.ttf")}}')  format('truetype');
		}

		@font-face {
		    font-family: BebasKai;
		    src: url('{{asset("fonts/bebas_kai/BebasKai-Regular.eot?#iefix")}}') format('embedded-opentype'), 
		         url('{{asset("fonts/bebas_kai/BebasKai-Regular.woff")}}') format('woff'), 
		         url('{{asset("fonts/bebas_kai/BebasKai-Regular.ttf")}}')  format('truetype');
		}

		@font-face {
		    font-family: Exo;
		    src: url('{{asset("fonts/exo/Exo-Light.ttf")}}');
		    unicode-range: U+30-39;
		}
	</style>

	{{-- Stand css --}}
	<link rel="stylesheet" href="{{asset('css/stand.css')}}">

	{{-- Main css --}}
	<link rel="stylesheet" href="{{asset('css/main.css')}}">

	{{-- Landing css --}}
	<link rel="stylesheet" href="{{asset('css/landing.css')}}">

	{{-- Cart css --}}
	<link rel="stylesheet" href="{{asset('css/cart.css')}}">

	{{-- Home css --}}
	<link rel="stylesheet" href="{{asset('css/home.css')}}">

	{{-- Material icons --}}
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">       

</head>