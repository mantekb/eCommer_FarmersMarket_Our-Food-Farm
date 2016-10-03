
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
	        $('#account-main').html(name);
	        $('#account-mobile').html(name);
	    }
	});
});