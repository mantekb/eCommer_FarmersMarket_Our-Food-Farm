
//When creating a stand, get the coordinates of the stand and save it.
$('#createStand').on('submit', function(e) {
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
		$('#'+e.target.id).submit();
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

