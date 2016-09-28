$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
});

//Prepent all your ajax urls with this
var DOCUMENT_ROOT = $('#DOCUMENT_ROOT').val();