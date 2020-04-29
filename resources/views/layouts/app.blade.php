<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.head')
<body>

<div id="app">
    @if( Auth::User() )
        @if(auth()->user()->isAdmin() == 2);
            <nav class="navbar navbar-expand-md navbar-light bg-cream shadow-sm fixed-top " style="padding: 0">
                <div class="containerHeader bg-cream" style="height: 90px">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent" style="display: flex">
                        <!-- Left Side Of Navbar -->
                        <a class="navbar-brand " href="{{ url('/') }}">
                            <img src="../Images/logo.svg" height="100%" width="80%" >
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <ul class="navbar-nav mr-auto navBarAmgros bg-cream" style="padding-top: 1.5%">
                            <li class="nav-item" style="padding-right: 40px">
                                <a class="nav-link font-navbar" href="guests" style="font-size: x-large; color: black"> Gæste overblikket </a>
                            </li>
                            <li class="nav-item" style="padding-right: 40px">
                                <a class="nav-link font-navbar" href="registerGuest" style="font-size: x-large; color: black"> Registrer ny gæst </a>
                            </li>
                            <li class="nav-item" style="padding-right: 40px">
                                <a class="nav-link font-navbar" href="https://www.dst.dk/da/Statistik" style="font-size: x-large; color: black"> Statistikker </a>
                            </li>
                            <li class="nav-item" style="padding-right: 40px">
                                <a class="nav-link font-navbar" href="guestsRegistration" style="font-size: x-large; color: black"> Gæstesiden </a>
                            </li>

                        </ul>
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto navBarAmgros bg-cream">
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item" style="padding-right: 40px">
                                    <a class="nav-link font-navbar" style="font-size: x-large; color: black" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item" style="padding-right: 40px">
                                        <a class="nav-link font-navbar" style="font-size: x-large; color: black" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
            Hello Admin
        @else
            Hello standard user
@endif
@endif



    <main class="py-4">
        @yield('content')
    </main>

</div>
</body>
@include('layouts.footer')
</html>
