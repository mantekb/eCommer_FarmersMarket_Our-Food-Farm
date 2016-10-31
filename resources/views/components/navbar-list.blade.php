
{{-- <li><a href="/food">Food</a></li> --}}
<li><a href="{{url("/deals")}}">Deals of the Day</a></li>
<li><a href="{{url("/learning")}}">Learning Resources</a></li>
@if(Auth::guest())
	<li><a class="login" href="{{url("/login")}}">Login</a></li>
	{{-- <li><a href="{{url("/register")}}">Register</a></li> --}}
@else
<li><a class="dropdown-button" id="name-account-{{$identity}}"
 data-beloworigin="true" data-activates="account-{{$identity}}" data-constrainwidth="false">
	{{Auth::user()->name}}
</a></li>
    <ul id="account-{{$identity}}"  class="dropdown-content">
    	@if(!Auth::user()->hasStand())
		    <li><a href="{{url("/stand/create")}}">Create Stand</a></li>
		@else
			<li><a href="{{url(Auth::user()->standRoute())}}">{{Auth::user()->stand->name}}</a></li>
			<li><a href="{{url('/stand/products')}}">Add/Edit Products</a></li>
		@endif
		<li><a href="{{url("/settings")}}">Settings</a></li>
		<li><a href="{{url("/logout")}}">Logout</a></li>
    </ul>
<li><a class="dropdown-button" id="cart-dropdown-trigger-{{$identity}}"
 data-beloworigin="true" data-activates="cart-dropdown-{{$identity}}" data-constrainwidth="false">
	Cart
</a></li>
	<ul class="dropdown-content" id="cart-dropdown-{{$identity}}">
		{{-- Cart Data Goes Here --}}
	</ul>
@endif
