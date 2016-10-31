<nav class="white ldu z-depth-0">
	<div class="nav-wrapper">
		<a href="{{url("/home")}}" class="brand-logo light-green-text logo">OurFoodFarm</a>
		<a href="#" data-activates="nav-mobile" id="nav-mobile-trigger" class="hamburger light-green-text button-collapse">
			<i class="material-icons">menu</i>
		</a>
		<ul id="nav-web" class="right light-green-text hide-on-med-and-down">
			@include('components.navbar-list', ['identity' => 'main'])

			{{-- This is copied in multiple places so they show at different times in the same place. --}}
			<a href="#" data-activates="cart-mobile" class="light-green-text cart-mobile-trigger button-collapse show-on-large">
				<i class="material-icons">shopping_cart</i>
			</a>
		</ul>
		{{-- Similar, but slightly different from cart icon above --}}
		<a href="#" data-activates="cart-mobile" id="cart-mobile-trigger" class="light-green-text cart-mobile-trigger button-collapse">
			<i class="material-icons">shopping_cart</i>
		</a>

		<ul id="nav-mobile" class="side-nav">
			<li class="black light-green-text"><a id="closeSideNav">Close Menu</a></li>
			@include('components.navbar-list', ['identity' => 'mobile'])
		</ul>
		<ul id="cart-mobile" class="side-nav">
			<li class="black light-green-text"><a id="closeSideCart">Close Cart</a></li>
			<li class="light-green-text" id="cartSlideOut">
				@if(Session::has('cart'))
					@include('shopping.cart-table', ['cart' => Session::get('cart')])
				@else
					<h3 class="center-align">Nothing in your cart.</h3>
				@endif
			</li>
		</ul>
	</div>
</nav>