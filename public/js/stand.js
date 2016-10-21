
//When creating a stand, get the coordinates of the stand and save it.
$('#submitCreateStand').on('click', function(e) {
	//Stop the form from submitting.
	e.preventDefault();
	//Create address object to get coordinates of.
	var address = {};
	address.address = $('#address').val()
	address.city = $('#city').val()
	address.state = $('#state').val()
	address.zip = $('#zip').val()
	createCoordsFromAddress(address, function(lat, long) {
		//Call back function we call when coordinates com back, so we submit form.
		$('#lat').val(lat);
		$('#long').val(long);
		$('#createStand').submit();
	}, 
	function() {
		// This function is called if there is an error retrieving coordinates.
		swal('Error', 'Could not retrieve coordinates for showing on map. Please ensure your location is correct.');
	});
})

function repositionMap() {
	var width = $(window).width();
	if (width <= 618)
	{
		$('.map').removeClass('col');
	}
	else
	{
		$('.map').addClass('col');
	}
}
if ($('.map').length > 0)
{
	repositionMap();
}

$(window).resize(function() {
	repositionMap();
});


//Create the map object for a stand
if ($('#standMap').length > 0)
{

	//Stand information for the map.
	var lat = $('#lat').val();
	var long = $('#long').val();
	var standName = $('#standName').html();

	mapboxgl.accessToken = MAPBOX_KEY;
	var map = new mapboxgl.Map({
		container: 'standMap',
		style: 'mapbox://styles/mapbox/streets-v9',
		center: [long, lat], //Start centered on stand instead of flyto
		zoom: 13
	});

	map.on('load', function() {
		//Once the map loads, place a marker where the stand should be.
		placeMarker(map, lat, long, standName);
	});
}

$('#submitCreateProduct').on('click', function(e) {
	e.preventDefault();
	//Get the form data
	var name = $('#name').val();
	var description = $('#description').val();
	var price = $('#price').val();
	var stock = $('#stock').val();
	var type = 'new';//$('#type').val();
	$.ajax({
	    url: DOCUMENT_ROOT+'/stand/products',
	    type: 'POST',
	    data: {
	    	name: name,
	    	description: description,
	    	price: price,
	    	stock: stock,
	    	type: type,
	    },
	    error: (response) => {
	        swal('Error', 'Could not create product.');
	    },
	    success: (response) => {
	        //Response is the card that has the product information
	        $('#products').append(response);
	        //Clear inputs.
	        $('#name').val('');
			$('#description').val('');
			$('#price').val('');
			$('#stock').val('');
	    }
	});
});

var editPrefix = '#edit_product_';
var inputNames = ['name', 'description', 'price', 'stock'];
$('.edit-product').on('click', function(e) {
	e.preventDefault();
	var id = e.target.id.replace('product_edit-', '');
	//Prefill the values in the modal.
	for (var i = 0; i < inputNames.length; i++)
	{
		$(editPrefix+inputNames[i]).val($('#product_'+inputNames[i]+'-'+id).html());
		//Trigger the label to move out of the way of the input - materialize
		$(editPrefix+inputNames[i]).change();
	}

	$(editPrefix+'modal').attr('data-product', id);

	//Display modal to edit the product.
	$(editPrefix+'modal').openModal();
});

$(editPrefix+'update').on('click', function(e) {
	e.preventDefault();
	var name = $(editPrefix+'name').val();
	var description = $(editPrefix+'description').val();
	var price = $(editPrefix+'price').val();
	var stock = $(editPrefix+'stock').val();
	var type = 'edit';//$('#type').val();
	var product_id = $(editPrefix+'modal').attr('data-product');
	$.ajax({
	    url: DOCUMENT_ROOT+'/stand/products',
	    type: 'POST',
	    data: {
	    	name: name,
	    	description: description,
	    	price: price,
	    	stock: stock,
	    	type: type,
	    	product_id: product_id,
	    },
	    error: (response) => {
	        swal('Error', 'Product could not be updated.');
	    },
	    success: (response) => {
	    	var product = JSON.parse(response);
	    	if (!product.error)
	    	{
		        //Edit the card on the page as well.
		        for (var i = 0; i < inputNames.length; i++)
		        {
		        	$('#product_'+inputNames[i]+'-'+product.id).html(product[inputNames[i]]);
		        }
		        //Close the modal.
		        $(editPrefix+'modal').closeModal();
		    }
		    else
		    {
		    	swal('Error', product.error);
		    }
	    }
	});
});