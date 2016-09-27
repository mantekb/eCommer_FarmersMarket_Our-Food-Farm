<!DOCTYPE html>
<html>
    @include('includes.head')
    <body>
        <span id="navDiv">
        	@include('components.navbar')
        </span>
        <div class="container">
            <div class="content">
                @include('auth.loginForm')

                @yield('content')

            </div>
        </div>
    </body>
    @include('includes.script')   
</html>
