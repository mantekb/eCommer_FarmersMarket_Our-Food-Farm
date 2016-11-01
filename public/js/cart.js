$('.add-to-cart').on('click', function(e) {
	e.preventDefault();
	var product_id = e.target.id.replace('product_id-', '');
	$.ajax({
	    url: DOCUMENT_ROOT+'/cart/add/'+product_id,
	    type: 'POST',
	    data: {
	    	quantity: 1,
	    },
	    error: (response) => {
	        swal('Error', 'Could not add product to your cart.');
	    },
	    success: (response) => {
	    	//Update the cart slideout with the new display.
	        $('#cartSlideOut').html(response);
	        Materialize.toast($('#product_name-'+product_id).html()+" added to cart.", 4000);
	    }
	});
});

$('.remove-product').on('click', function(e) {
	e.preventDefault();
	var product_id = e.target.id.replace('rm-', '');
	$.ajax({
	    url: DOCUMENT_ROOT+'/cart/remove/'+product_id,
	    type: 'POST',
	    error: (response) => {
	        swal('Error', 'Could not remove product from cart.');
	    },
	    success: (response) => {
	        //Remove that row from the table.
	        $('#'+e.target.id).parent().parent().remove();
	        //Update the slideout with the response.
	        $('#cartSlideOut').html(response);
	    }
	});
})