
$('#changeName').on('click', function(e) {
	e.preventDefault();
	var name = $('#name').val();
	$.ajax({
	    url: DOCUMENT_ROOT+'/settings/name',
	    type: 'POST',
	    data: {
	    	name: name,
	    },
	    error: (response) => {
	        swal('Error', "Unable to change name.");
	    },
	    success: (response) => {
	        swal('Success', "Your name has changed to "+name+".");
	        $('#name-account-main').html(name);
	        $('#name-account-mobile').html(name);
	    }
	});
});

$('changePassword').on('click', function(e) {
	e.preventDefault();
	var new_password = $('new_password').val();
	var conf_password = $('conf_password').val();
	$.ajax({
		url: DOCUMENT_ROOT+'/settings/password',
		type: 'POST',
		data: {
			new_password: new_password,
			conf_password: conf_password,
		},
		error: (response) => {
			swal('Error', "Unable to change password.");
		},
		success: (response) => {
			swal('Success', "Your password has been changed.");
		}
	});
});

$('changeAddress').on('click', function(e) {
	e.preventDefault();
	var address = {};
	address.address = $('#address').val()
	address.city = $('#city').val()
	address.state = $('#state').val()
	address.zip = $('#zip').val()
	createCoordsFromAddress(address, var coordinates = function(lat, long) {
		//Call back function we call when coordinates com back, so we submit form.
		coordinates.lat = $('#lat').val(lat);
		coordinates.long = $('#long').val(long);
		return coordinates;
	});

	$.ajax({
		url: DOCUMENT_ROOT+ '/settings/address',
		type: 'POST',
		data: {
			address: address,
			coordinates: coordinates,
		},
		error: (response) => {
			swal('Error', "Unable to change address.");
		},
		success: (response) => {
			swal('Success', "Your address has been changed.")
		}
	});
});

function removeStand()
{
	$.ajax({
	    url: DOCUMENT_ROOT+'/settings/removeStand',
	    type: 'POST',
	    error: (response) => {
	        swal('Error', 'Could not remove your stand.');
	    },
	    success: (response) => {
	        swal('Success', 'Your stand has been removed.');
	    }
	});
}