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
	        updateCartDropDown(JSON.parse(response));
	    }
	});
});

// This handles updating the cart dropdown upon adding an item to the cart.
function updateCartDropDown(cart)
{
	//Grab the div we hold the dropdown cart in.
	var cartDropDown = $('#cartDropDown');
	//Reset the html inside the div.
	cartDropDown.html('');
	var numProducts = cart.length;
	for (var i = 0; i < numProducts; i++)
	{
		var currDiv = '';
		cartDropDown.append(currDiv);
	}
}