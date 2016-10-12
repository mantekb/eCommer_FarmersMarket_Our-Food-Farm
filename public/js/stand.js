
//When creating a stand, get the coordinates of the stand and save it.
$('#submitCreateStand').on('click', function(e) {
	//Stop the form from submitting.
	e.preventDefault();
	//Create address object to get coordinates of.
	var address = {};
	address.address = $('#address').val()
	address.city = $('#city').val()
	address.state = $('#state').val()
	address.zip = $('#zip').val()
	createCoordsFromAddress(address, function(lat, long) {
		//Call back function we call when coordinates com back, so we submit form.
		$('#lat').val(lat);
		$('#long').val(long);
		$('#createStand').submit();
	});
})

function repositionMap() {
	var width = $(window).width();
	if (width <= 618)
	{
		$('.map').removeClass('col');
	}
	else
	{
		$('.map').addClass('col');
	}
}
if ($('.map').length > 0)
{
	repositionMap();
}

$(window).resize(function() {
	repositionMap();
});


//Create the map object for a stand
if ($('#standMap').length > 0)
{

	//Stand information for the map.
	var lat = $('#lat').val();
	var long = $('#long').val();
	var standName = $('#standName').html();

	mapboxgl.accessToken = MAPBOX_KEY;
	var map = new mapboxgl.Map({
		container: 'standMap',
		style: 'mapbox://styles/mapbox/streets-v9',
		center: [long, lat], //Start centered on stand instead of flyto
		zoom: 13
	});

	map.on('load', function() {
		//Once the map loads, place a marker where the stand should be.
		placeMarker(map, lat, long, standName);
	});
}