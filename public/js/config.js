
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