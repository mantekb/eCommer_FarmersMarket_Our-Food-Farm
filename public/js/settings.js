
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