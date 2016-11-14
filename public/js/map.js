var GEOCODE_KEY = "6e256225eae872958e945279678fa95952f2f5a";
var MAPBOX_KEY = 'pk.eyJ1IjoiaW5zYW5lYWxlYyIsImEiOiJjaXN0Y3VtMDIwM2szMnpsOGFyNzBranpiIn0.t73_pX_gZy5govr5LM9liA';
var map = null;

//If the map element exists, init the map, then load the position.
if ($('#map').length > 0){
    // My personal accessToken, do not keep
    mapboxgl.accessToken = MAPBOX_KEY;
    map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v9'
    });

    map.on('load', function() {
        var zip = window.location.href;
        zip = zip.substring(zip.indexOf("zip=")+4);
        if (!(zip.trim() === "") && zip.length < 9){
            $('#zip').text(zip);
            $('#zip-input').val(zip);
            $("#zip-search").click();
        } else if ($('#user-lat').length > 0 && $('#user-long').length > 0) {
            retrieveUserAddress();
        } else {
            if (navigator.geolocation)
                navigator.geolocation.getCurrentPosition(sendPosition);
        }
    });
}


function sendPosition(position) {
    showPosition(position.coords.latitude, position.coords.longitude);
}

function showPosition(lat, long, zoom) {
    zoom = zoom || 10;
    map.flyTo({
        center: [
            long,
            lat],
            zoom: zoom
    });
}

$("#zip-input").keyup(function(event){
    if(event.keyCode == 13){
        $("#zip-search").click();
    }
});

$('#zip-search').click(function(){
    if (zip === undefined)
        var zip = $('#zip-input').val();
    zip = validateZip(zip);
    $('#zip').text(zip);
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
    showResults("", zip);
});


function validateZip(zip) {
    if (zip.length >= 5){
        zip = zip.substring(0, 5);
        if (zip.match('[0-9]{5}')){
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

function createCoordsFromAddress(address, callback, errorCallback)
{
    //Remove token so we can call service
    deleteToken();
    //See if we passed in the callback, if not make empty.
    callback = callback || function(lat, long){};
    errorCallback = errorCallback || function(lat, long){};
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
            errorCallback();
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
    var display = '<p>'+title+'</p>';
    var ll = new mapboxgl.LngLat(long, lat);
    new mapboxgl.Popup()
      .setLngLat(ll)
      .setHTML(display)
      .addTo(map);
}

function removeMarkers(){
    $('.mapboxgl-popup-close-button').each(function(){
        $(this).click();
    });
}

function retrieveUserAddress()
{
    var lat = $('#user-lat').val()
    var long = $('#user-long').val()
    showPosition(lat, long);
    // var address = {};
    // address.address = $('#user-address').val();
    // address.city = $('#user-city').val();
    // address.state = $('#user-state').val();
    // address.zip = $('#user-zip').val();
    // createCoordsFromAddress(address, function(lat, long) {
    //     showPosition(lat, long);
    // });
}

$('#change-zip').click(function(){
    document.getElementById("zip-dropdown").classList.toggle("hide");
})

$('#zip-input').click(function(){
    $('#zip-input').val("");
})

window.onclick = function(event) {
    if (!event.target.matches('.zip-dropdown-items')) {
        var openDropdown = document.getElementById("zip-dropdown");
        if (!openDropdown.classList.contains('hide')) {
            openDropdown.classList.add('hide');
        }
    }
}

$('#zip-search').click(function(){
    var searchTerms = $('#search-input').val();
    var zip = $('#zip').text();
    showResults(searchTerms, zip);
})

$('#search-button').click(function(){
    var searchTerms = $('#search-input').val();
    var zip = $('#zip').text();
    showResults(searchTerms, zip);
})

function showResults(term, zip){
    $.ajax({
        url: DOCUMENT_ROOT+'/search',
        type: 'POST',
        data: {
            val: term,
            zip: zip
        },
        error: function(response) {
            swal('Error', 'Sorry, we could not find your location.');
        },
        success: function(response) {
            var results = response;
            removeMarkers();
            for (var i = 0; i < results.length; i++){
                placeMarker(map, results[i].lat, results[i].long, results[i].name);
            }
        },
    });
}
