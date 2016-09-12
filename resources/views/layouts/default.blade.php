<!DOCTYPE html>
<html>
    @include('includes.head')
    <body>
    	@include('components.navbar')
        <div class="container">
            <div class="content">

                @yield('content')

            </div>
        </div>
    </body>
    @include('includes.script')   
</html>