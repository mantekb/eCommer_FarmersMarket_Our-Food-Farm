$('.datepicker').pickadate({
	selectMonths: true, // Creates a dropdown to control month
	selectYears: 80 // Creates a dropdown of 80 years to control year
});

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