$('input[name="paymentGroup"]').on('click', function(e) {
	//Show the form to fill out credit card if that's what they choose.
	if (e.target.id == 'payCard')
	{
		$('#ccForm').show();
	}
	else
	{
		$('#ccForm').hide();
	}
});

$('#submitCheckoutPaymentForm').on('click', function(e) {
	e.preventDefault();
});