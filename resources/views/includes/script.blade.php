{{-- Here we include all necessary scripts. --}}


<script src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>
<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>

<script src="{{asset('js/materialize-init.js')}}"></script>

<script>
    $(window).bind('resize', function() {
        var float_width = $('#map').width();
        var doc_width = $(document).width();
        if (doc_width < 601)
        {
        	$('#map').css('width', '80%');
        }
    });
</script>