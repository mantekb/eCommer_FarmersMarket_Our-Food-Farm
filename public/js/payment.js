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

$('#submitpaymentinfo').on('click', function(e) {
	e.preventDefault();
	var firstname = $('#firstname').val();
	var lastname = $('#lastname').val();
	var DOB = $('#DOB').val();
	var address = $('#address').val();
	var city = $('#city').val();
	var state = $('#state').val();
	var zip = $('#zip').val();

	

	// $.ajax({
	//     url: DOCUMENT_ROOT+'/settings/name',
	//     type: 'POST',
	//     data: {
	//     	name: name,
	//     },
	//     error: (response) => {
	//         swal('Error', "Unable to change name.");
	//     },
	//     success: (response) => {
	//         swal('Success', "Your name has changed to "+name+".");
	//         $('#name-account-main').html(name);
	//         $('#name-account-mobile').html(name);
	//     }
	// });
});