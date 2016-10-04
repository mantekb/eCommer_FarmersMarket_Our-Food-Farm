//If the map element exists, init the map, then load the position.
if ($('#map').length > 0){
    // My personal accessToken, do not keep
    mapboxgl.accessToken = 'pk.eyJ1IjoiaW5zYW5lYWxlYyIsImEiOiJjaXN0Y3VtMDIwM2szMnpsOGFyNzBranpiIn0.t73_pX_gZy5govr5LM9liA';
    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v9'
    });

    map.on('load', function() {
        if (navigator.geolocation)
        {
            navigator.geolocation.getCurrentPosition(sendPosition, showError);
        }
        else
        {
            swal("Uh oh!", 
                "Geolocation is not supported by this browser.\nTry updating your browser, or using a different one."
            );
        }
    });
}

function sendPosition(position)
{
    showPosition(position.coords.latitude, position.coords.longitude);
}

function showPosition(lat, long) {
    map.flyTo({
        center: [
            long,
            lat],
            zoom: 11
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
    $.post(DOCUMENT_ROOT+'/location/get-lat-long', {
        zip : zip
    })
    .done(function(data) {
        var result = JSON.parse(data);
        if (result.error){ //i.e. we don't have the geolocation saved yet
            createCoords(zip);
        }
        else {
            showPosition(result.Lat, result.Long);
        }
    })
    .fail(function() {
        swal("Oops!", "An unknown error has occurred.")
    });
    //Then we want to unfocus the input to make it easier for mobile.
    $('#zipcode').blur();
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
        error: function(response) {
            swal('Error', 'Sorry, we could not find your location.');
        },
        success: function(response) {
            //parse response object
            var lat = response.results[0].location.lat;
            var long = response.results[0].location.lng;
            showPosition(lat, long);
            //now save the coordinates for next time
            saveCoords(zip, lat, long);
        },
    });
    //Reset the token once call happens.
    setToken();
}

function saveCoords(zip, lat, long)
{
    $.ajax({
        url: DOCUMENT_ROOT+'/location/save',
        type: 'POST',
        data: {
            zip: zip,
            lat: lat,
            long: long,
        }
    });
}