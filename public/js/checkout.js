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
	//Check what is checked in order to determine to proceed.
	var payType = $('input[name="paymentGroup"]:checked').attr('id');
	if (payType === "payCash")
	{
		// Don't do any payment stuff
	}
	else if (payType === "payCard")
	{
		// collect payment information
	}
	else if (payType === "savedCC")
	{
		// In the backend, use the saved token
	}

	$('#payType').val(payType);
});