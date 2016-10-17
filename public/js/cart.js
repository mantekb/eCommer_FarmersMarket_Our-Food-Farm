$('.add-to-cart').on('click', function(e) {
	e.preventDefault();
	var product_id = e.target.id.replace('product_id-', '');
	$.ajax({
	    url: DOCUMENT_ROOT+'/cart/add/'+product_id,
	    type: 'POST',
	    error: (response) => {
	        swal('Error', 'Could not add product to your cart.');
	    },
	    success: (response) => {
	        console.log(JSON.parse(response));
	    }
	});
});