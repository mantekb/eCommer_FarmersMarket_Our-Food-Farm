
<li><a href="/stands">Stands</a></li>
<li><a href="/food">Food</a></li>
@if(Auth::guest())
	<li><a href="/login">Login</a></li>
	<li><a href="/register">Register</a></li>
@else
	<li><a href="/account">Account</a></li>
@endif
