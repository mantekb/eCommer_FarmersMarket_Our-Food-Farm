var GEOCODE_KEY = "6e256225eae872958e945279678fa95952f2f5a";
var MAPBOX_KEY = 'pk.eyJ1IjoiaW5zYW5lYWxlYyIsImEiOiJjaXN0Y3VtMDIwM2szMnpsOGFyNzBranpiIn0.t73_pX_gZy5govr5LM9liA';
//If the map element exists, init the map, then load the position.
if ($('#map').length > 0){
    // My personal accessToken, do not keep
    mapboxgl.accessToken = MAPBOX_KEY;
    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v9'
    });

    map.on('load', function() {
        //Automatically get location.
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

function showPosition(lat, long, zoom) {
    zoom = zoom || 11;
    map.flyTo({
        center: [
            long,
            lat],
            zoom: zoom
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
    deleteToken();
    $.ajax({
        url: "http://api.geocod.io/v1/geocode?postal_code="+zip+"&api_key="+GEOCODE_KEY,
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

function createCoordsFromAddress(address, callback)
{
    //Remove token so we can call service
    deleteToken();
    //See if we passed in the callback, if not make empty.
    callback = callback || function(lat, long){};
    //Default to accept address as a string
    var addressString = address;
    //If address is an object, parse it into a string.
    if (address !== null && typeof address === 'object')
    {
        addressString = address.address
            + ", " + address.city 
            + " " + address.state 
            + ", " + address.zip; 
    }
    //Escape characters for URL
    addressString = encodeURIComponent(addressString);
    //Make request
    $.ajax({
        url: 'https://api.geocod.io/v1/geocode?q='+addressString+'&api_key='+GEOCODE_KEY,
        type: 'GET',
        error: (response) => {
            //Do Nothing: could not get coordinates
        },
        success: (response) => {
            var lat = response.results[0].location.lat;
            var long = response.results[0].location.lng;
            callback(lat, long);
        }
    });
    //Reset our security token
    setToken();
}

function placeMarker(map, lat, long, title)
{
    var display = '<div class="card"><div class="card-content">'
        +title
    +'</div></div>';
    var ll = new mapboxgl.LngLat(long, lat);
    new mapboxgl.Popup()
      .setLngLat(ll)
      .setHTML(display)
      .addTo(map);
}