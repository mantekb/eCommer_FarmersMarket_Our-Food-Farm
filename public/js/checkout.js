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
	var proceed = true;
	var payType = $('input[name="paymentGroup"]:checked').attr('id');
	if (payType === "payCard")
	{
		//Ensure CC form filled out before submitting
		if (
			$('#ccNum').val() == '' &&
			$('#ccCVC').val() == '' &&
			$('#ccMonth').val() == '' &&
			$('#ccYear').val() == ''
		)
		{
			proceed = false;
		}
		
	}
	//More easily pass payment type.
	$('#payType').val(payType);

	if (proceed)
	{
		//Submit the form.
		$('#checkoutPayment').submit();
	}
	else
	{
		swal('Error', 'Ensure all fields are filled out before continuing.');
	}
});