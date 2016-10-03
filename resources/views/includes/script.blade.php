{{-- Here we include all necessary scripts. --}}


<script src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>
<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>
<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.23.0/mapbox-gl.js'></script>

<script src="{{asset('js/materialize-init.js')}}"></script>
<script src="{{asset('js/sweetalert.min.js')}}"></script>
{{-- Make sure config.js comes first! --}}
<script src="{{asset('js/config.js')}}"></script>
<script src="{{asset('js/map.js')}}"></script>
<script src="{{asset('js/auth.js')}}"></script>
<script src="{{asset('js/stand.js')}}"></script>
