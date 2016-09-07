
{{-- <li><a href="/food">Food</a></li> --}}
<li><a href="/">Map</a></li>
<li><a href="/learning">Learning Resources</a></li>
@if(Auth::guest())
	<li><a href="/login">Login</a></li>
	<li><a href="/register">Register</a></li>
@else
	<li><a href="/account">Account</a></li>
@endif
