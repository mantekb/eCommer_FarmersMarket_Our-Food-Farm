<!DOCTYPE html>
<html>
    @include('includes.head')
    <body>
        <span id="navDiv">
            @include('components.navbar')
        </span>
        <div class="container">
            <input id="DOCUMENT_ROOT" hidden="hidden" style="display: none;" value="{{url('/')}}">
            <div class="content">
                @include('auth.loginForm')

                @yield('content')

            </div>
        </div>
    </body>
    @include('includes.script')   
</html>
