
{{-- <li><a href="/food">Food</a></li> --}}
<li><a href="{{url("/")}}">Map</a></li>
<li><a href="{{url("/learning")}}">Learning Resources</a></li>
@if(Auth::guest())
	<li><a href="{{url("/login")}}">Login</a></li>
	<li><a href="{{url("/register")}}">Register</a></li>
@else
	<li><a href="{{url("/account")}}">Account</a></li>
@endif
