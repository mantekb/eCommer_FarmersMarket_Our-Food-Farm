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
	        //Update the new total quantity and price
	        getTotalQuantityAndPrice();
	        //Remove that row from the table.
	        $('#'+e.target.id).parent().parent().remove();
	        //Update the slideout with the response.
	        $('#cartSlideOut').html(response);
	    }
	});
});

function getTotalQuantityAndPrice()
{
	$.ajax({
	    url: DOCUMENT_ROOT+'/cart/getTotals',
	    type: 'GET',
	    error: (response) => {
	        //Do nothing
	    },
	    success: (response) => {
	        var totals = JSON.parse(response);
	        // Check to make sure something was returned.
	        if (!totals.error)
	        {
	        	$('.totalQuantity').html(totals.quantity);
	        	$('.totalPrice').html(totals.price);
	        }
	    }
	});
}

//The below checks if an item's quantity has been updated,
// if so, prevent moving on to checkout
//A list of the changed products.
var changedQuantities = [];
//Only run on the view-cart page
if ($('.remove-product').length > 0)
{
	$('.quantity :input').on('change', function(e) {
		var id = e.target.id;
		var product_id = id.replace('quant_input-', '')
		var jQElem = $('#'+id);
		var newQuant = jQElem.val();
		//Remove from the list if it's in there.
		removeFromChangedQuantities(product_id);
		if (jQElem.data('origQuant') != newQuant)
		{
			//Quantity has changed, make input red and disable the checkout button.
			jQElem.addClass('red');
			changedQuantities.push({'id':product_id, 'quantity':newQuant})
			disableCheckoutLink();
		}
		else
		{
			jQElem.removeClass('red');
			changedQuantities();
		}
	});
}

function disableCheckoutLink()
{
	$('#checkoutBtn').prop('disabled', true);
	$('#updateCartForm').show();
}

function enableCheckoutLink()
{
	$('#checkoutBtn').prop('disabled', false);
	$('#updateCartForm').hide();
}

function checkQuantities()
{
	//Check if all the inputs are back to normal.
	var inputs = $('.quantity :input');
	var numProducts = inputs.length;
	var i = 0;
	var isOkay = true;
	while(i < numProducts && isOkay)
	{
		//Regex returns true if red is in the list of classes.
		if (/\bred\b/.test(inputs[i].className))
		{
			isOkay = false;
		}
		i++;
	}
	//If red isn't in any of them, re-enable the checkout button.
	if(isOkay)
	{
		enableCheckoutLink();
	}
}

$('#checkoutBtn').on('click', function() {
	var link = $('#checkoutBtn').data('link');
	window.location.href = link;
});

$('#updateCartBtn').on('click', function(e) {
	$.ajax({
	    url: DOCUMENT_ROOT+'/cart/update',
	    type: 'POST',
	    data: {
	    	list: JSON.stringify(changedQuantities),
	    },
	    error: (response) => {
	        swal('Error', 'Could not update cart.');
	    },
	    success: (response) => {
	        //Update the new total quantity and price
	        getTotalQuantityAndPrice();
	        //Update the slideout with the response.
	        $('#cartSlideOut').html(response);
	        //Update the view-cart's table.
	        updateChangedQuantities();
	    }
	});
});

function removeFromChangedQuantities(id)
{
	var numChanged = changedQuantities.length;
	var i = 0;
	var removed = false;
	while(i < numChanged && !removed)
	{
		if(changedQuantities[i].id == id)
		{
			changedQuantities.splice(i, 1);
			removed = true;
		}
		i++;
	}
}

function updateChangedQuantities()
{
	var numUpdated = changedQuantities.length;
	for(var i = 0; i < numUpdated; i++)
	{
		$('#quant_input-'+changedQuantities[i].id).data('origQuant', changedQuantities[i].quantity);
		$('#quant_input-'+changedQuantities[i].id).removeClass('red');
	}
	//Reset the list
	changedQuantities = [];
	checkQuantities();
}