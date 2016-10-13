<nav class="white ldu z-depth-0">
	<div class="nav-wrapper">
		<a href="{{url("/home")}}" class="brand-logo light-green-text logo">OurFoodFarm</a>
		<a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
		<ul id="nav-web" class="right light-green-text hide-on-med-and-down">
			@include('components.navbar-list', ['identity' => 'main'])
		</ul>
		<ul id="nav-mobile" class="light-green-text side-nav">
			@include('components.navbar-list', ['identity' => 'mobile'])
		</ul>
	</div>
</nav>