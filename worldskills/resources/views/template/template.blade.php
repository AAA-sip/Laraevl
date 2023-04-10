<!doctype html>
<html lang="en">
<head>
    <title>@yield('Ttitle', 'Template')</title>
    <link href="{{asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{asset('css/style.css') }}" rel="stylesheet">
</head>
<body>




    <div class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-between py-3 mb-4 border-bottom">
            <h3><a class="text-dark" href="#">WorldSkills</a></h3>

            <div>
                @if(auth()->check())

                    @if (Auth::user()->admin())
                        <a class="btn btn-outline-primary me-2 a" href="{{ route('admin') }}">Admin Panel</a>
                    @else
                        <a class="btn btn-outline-primary me-2 a" href="{{ route('profile') }}">My Profile</a>
                    @endif
                    <a href="/logout" class="btn btn-primary a">logout</a>
                @else
                    <a class="btn btn-outline-primary me-2 a" href="{{ route('register') }}">Register</a>
                    <a class="btn btn-primary a" href="{{ route('login') }}" >Login</a>
                @endif
            </div>
        </header>
    </div>








    @yield('TblockA')

    @yield('TblockB')

    @yield('TblockC')


</body>
</html>
