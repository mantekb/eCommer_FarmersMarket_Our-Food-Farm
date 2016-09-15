<nav class="green darken-4">
	<div class="nav-wrapper">
		<a href="{{url("/")}}" class="brand-logo">OurFoodFarm</a>
		<a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
		<ul id="nav-web" class="right hide-on-med-and-down">
			@include('components.navbar-list')
		</ul>
		<ul id="nav-mobile" class="side-nav">
			@include('components.navbar-list')
		</ul>
	</div>
</nav>