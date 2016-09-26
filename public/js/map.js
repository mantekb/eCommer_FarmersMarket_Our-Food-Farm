if ($('#map').length > 0){
	if (navigator.geolocation)
	    navigator.geolocation.getCurrentPosition(showPosition, showError);
	else
	    swal("Uh oh!", "Geolocation is not supported by this browser.\nTry updating your browser, or using a different one.");
}

function showPosition(position) {
	map.flyTo({
        center: [
            position.coords.longitude,
            position.coords.latitude],
            zoom: 10
    });
}

function showError(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            swal("Uh oh!", "Looks like you denied permission for geolocation.\nThat's ok, just use the search box to enter your location.");
            break;
        case error.POSITION_UNAVAILABLE:
            swal("Sorry!", "We weren't able to find you! Please try the search box.");
            break;
        case error.TIMEOUT:
            swal("Error", "Request timed out, please try again");
            break;
        case error.UNKNOWN_ERROR:
            swal("Error", "Please contact support.");
            break;
    }
}

$('#find').click(function(){
    var zip = $('#zipcode').val()
    zip = validateZip(zip);

});


function validateZip(zip) {
    zip = zip.substring(4);
    console.log(zip);
}
