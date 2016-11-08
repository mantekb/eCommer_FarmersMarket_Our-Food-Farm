// Ensure all the pre-filled materialize inputs have the label moved out of the way.
if (window.location.href == DOCUMENT_ROOT+'/payment')
{
	//Change all inputs in order to move label out of way of input - materialize
	$('form input[type=text]').each(function() {
		if($(this).val() != undefined)
		{
			$(this).change();
		}
	});
}

$('#submitpayinfo').on('click', function(e) {
	e.preventDefault();
	var firstname = $('#firstname').val();
	var lastname = $('#lastname').val();
	var cardNumber = $('#cardNumber').val();
	var expDate = $('#expDate').val();
	var cvc = $('#cvc').val();
	var DOB = $('#DOB').val();
	var address = $('#address').val();
	var city = $('#city').val();
	var state = $('#state').val();
	var zip = $('#zip').val();

	$.ajax({
	    url: DOCUMENT_ROOT+'/payment/createStripeAccount',
	    type: 'POST',
	    data: {
	    	firstname: firstname,
	    	lastname: lastname,
	    	cardNumber: cardNumber,
	    	expDate: expDate,
	    	cvc: cvc,
	    	DOB: DOB,
	    	address: address,
	    	city: city,
	    	state: state,
	    	zip: zip,
	    },
	    error: (response) => {
	        swal('Error', "Unable to create Stripe account.");
	    },
	    success: (response) => {
	        swal('Success', "Your stripe account has been created.");
	    }
	});
});