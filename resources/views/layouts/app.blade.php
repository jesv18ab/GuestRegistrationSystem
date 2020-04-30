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
                        <a class="navbar-brand " href="{{ url('/') }}" style="margin-right: 0px">
                            <img src="../Images/logo.svg" height="100%" width="80%" >
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <ul class="navbar-nav mr-auto navBarAmgros bg-cream " style="padding-top: 1.5%">
                            <li class="nav-item padding_right" >
                                <a class="nav-link font-navbar" href="guests" style="font-size: x-large; color: black"> Gæsteoverblikket </a>
                            </li>
                            <li class="nav-item padding_right" >
                                <a class="nav-link font-navbar" href="registerGuest" style="font-size: x-large; color: black"> Registrer ny gæst </a>
                            </li>
                            <li class="nav-item padding_right" >
                                <a class="nav-link font-navbar" href="updateUsers" style="font-size: x-large; color: black"> Opdateringer </a>
                            </li>
                            <li class="nav-item padding_right" >
                                <a class="nav-link font-navbar" href="createEmployeeView" style="font-size: x-large; color: black"> Opret medarbejder</a>
                            </li>

                        </ul>
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto navBarAmgros bg-cream" style="padding-top: 1.5%">
                            <!-- Authentication Links -->
                            <li class="nav-item padding_right" >
                                <a class="nav-link font-navbar" href="guestsRegistration" style="font-size: x-large; color: black"> Gæstesiden </a>
                            </li>
                                <li class="nav-item padding_right" >
                                    <a class="nav-link font-navbar" style="font-size: x-large; color: black" href="{{ route('logout') }}">{{ __('logout') }}</a>
                                </li>
                        </ul>
                    </div>
                </div>
            </nav>
        @elseif(auth()->user()->isAdmin() == 1)
            <nav class="navbar navbar-expand-md navbar-light bg-cream shadow-sm fixed-top " style="padding: 0">
                <div class="containerHeader bg-cream" style="height: 90px">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent" style="display: flex">
                        <!-- Left Side Of Navbar -->
                        <a class="navbar-brand " href="{{ url('/') }}" style="margin-right: 0px">
                            <img src="../Images/logo.svg" height="49.044px" width="300px" >
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <ul class="navbar-nav mr-auto navBarAmgros bg-cream " style="padding-top: 1.5%">
                            <li class="nav-item padding_right" >
                                <a class="nav-link font-navbar" href="registerGuest" style="font-size: x-large; color: black"> Registrer ny gæst </a>
                            </li>
                            <li class="nav-item" style="padding-right: 40px">
                                <a class="nav-link font-navbar" href="updateProfile" style="font-size: x-large; color: black"> Opdater profil </a>
                            </li>
                            <li class="nav-item" style="padding-right: 40px">
                                <a class="nav-link font-navbar" href="updateProfile" style="font-size: x-large; color: black"> Se dine kommende aftaler </a>
                            </li>

                        </ul>
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto navBarAmgros bg-cream" style="padding-top: 1.5%">
                            <!-- Authentication Links -->
                            <li class="nav-item padding_right" >
                                <a class="nav-link font-navbar" style="font-size: x-large; color: black" href="{{ route('logout') }}">{{ __('logout') }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>


                        @endif
@endif



    <main class="py-4">
        @yield('content')
    </main>

</div>
</body>
@include('layouts.footer')
</html>
