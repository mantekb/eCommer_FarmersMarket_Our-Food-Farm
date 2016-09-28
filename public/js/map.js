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

$("#zipcode").keyup(function(event){
    if(event.keyCode == 13){
        $("#find").click();
    }
});

$('#find').click(function(){
    var zip = $('#zipcode').val()
    zip = validateZip(zip);
    $.post('./get-lat-long', {
        zip : zip
    })
    .done(function(data) {
        if (data === ""){ //i.e. we don't have the geolocation saved yet
            createCoords(zip);
            //map.flyTo newly created coords
            //send request to saveGeoLocation
        }
    })
    .fail(function() {
        swal("Oops!", "An unknown error has occurred.")
    });
});


function validateZip(zip) {
    if (zip.length >= 5){
        zip = zip.substring(0, 5);
        if (zip.match('[0-9]{5}')){
            console.log(zip);
            return zip;
        } else
            swal("Whoops!", "Please make sure your zipcode is formatted correctly");
    }
}

function createCoords(zip){
    var key = "6e256225eae872958e945279678fa95952f2f5a";
    deleteToken();
    $.ajax({
        url: "http://api.geocod.io/v1/geocode?postal_code="+zip+"&api_key="+key,
        type: 'GET',
    }).always(function(response) {
        console.log(response);
        setToken();
    });
}