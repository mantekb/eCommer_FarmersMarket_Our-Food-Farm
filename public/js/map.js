if ($('#map').length > 0){
	if (navigator.geolocation)
	    navigator.geolocation.getCurrentPosition(showPosition, showError);
	else
	    swal("Geolocation is not supported by this browser.");
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
            swal("User denied the request for Geolocation.");
            break;
        case error.POSITION_UNAVAILABLE:
            swal("Location information is unavailable.");
            break;
        case error.TIMEOUT:
            swal("The request to get user location timed out.");
            break;
        case error.UNKNOWN_ERROR:
            swal("An unknown error occurred.");
            break;
    }
}

