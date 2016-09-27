
var loginHidden = true;
$('.login').on('click', function(e) {
	e.preventDefault();
	if (loginHidden)
	{
		hideLogin(false);
	}
	else
	{
		hideLogin(true);
	}
});

function hideLogin(hide)
{
	if(hide)
	{
		$('.loginForm').hide();
		loginHidden = true;
	}
	else
	{
		$('.loginForm').show();
		loginHidden = false;
	}
	$('#nav-mobile').sideNav('hide');
}

$('.loginSubmit').on('click', function(e) {
	e.preventDefault();
	login();
});

function login()
{
	var email = $('.loginForm [name="email"]').val();
	var password = $('.loginForm [name="password"]').val();
	$.ajax({
	    url: './login',
	    type: 'POST',
	    data: {
	    	email: email,
	    	password: password,
	    },
	    error: (response) => {
	    	loginError('Username or Password Incorrect.')
	    },
	    success: (response) => {
	    	if (response !== 'error')
	    	{
	    		hideLogin(true);
	    		$('#navDiv').html(response);
	    	}
	    	else
	    	{
	    		loginError('These credentials do not match our records.');
	    	}
	    }
	});
}

function loginError(msg)
{
	var err = '#loginError'
	$(err).parent().show();
	$(err).html(msg);
}
