
function setToken() {
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
	    }
	});
}
setToken();

function deleteToken() {
    delete $.ajaxSettings.headers["X-CSRF-TOKEN"]; // token header before calls
}

//Prepent all your ajax urls with this
var DOCUMENT_ROOT = $('#DOCUMENT_ROOT').val();

//Make sure hitting back button doesn't ruin the navbar.
function reloadNavBar() {
	$.ajax({
		cache: false,
	    url: DOCUMENT_ROOT+'/navbar',
	    type: 'GET',
	    error: (response) => {
	        //Do Nothing;
	    },
	    success: (response) => {
	    	var navDiv = $('#navDiv');
	        navDiv.html(response);
	        initNavBar();
	    }
	});
} reloadNavBar();

function initNavBar() {
	$(".button-collapse").sideNav();
	$('.dropdown-button').dropdown();
}