<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- ajax calls -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('assets/js/app.js') }}" defer></script>
    <script  src="{{ asset('assets/js/ajaxCalls.js') }}" defer></script>
    <script  src="{{ asset('assets/js/icons.js') }}" defer></script>
    <script  src="{{ asset('assets/js/admin.js') }}" defer></script>
    <script  src="{{ asset('assets/js/guest.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('assets/scss/mainStyle.css') }}" rel="stylesheet">


</head>

<body>

<div id="app">

    <nav class="navbar navbar-expand-md navbar-light bg-cream shadow-sm fixed-top " style="padding: 0">
        <div class="containerHeader bg-cream" style="height: 90px">
            <div class="collapse navbar-collapse" id="navbarSupportedContent" style="display: flex">
                <!-- Left Side Of Navbar -->
                <a class="navbar-brand right-margin "  style="margin-right: 4rem; margin-left: 38%;">
                    <img src="../Images/logo.svg" height="74px" width="379px" >
                </a>


            </div>
        </div>
    </nav>




    <main class="py-4">

        <div  class="container2 shadow" style="border: 1px solid black;  margin-left: 15%; height: 500px; width: 1100px; margin-top: 7%; background-color: white" >

            <p class="text-Check-In">Vælg venligst Check ind eller check ud</p>

            <div id="checkButtons" class="checkInAndOut">

                <div class="btnGuests shadow">
                    <a class="padding-button-2"  type="submit"  href="/guestMenu/checkIn" style="text-decoration: none" ><p > <b class="p" >Check in</b> </p> </a>
                </div>
                <div class="btnGuests2 shadow">
                    <div class="padding-button" style="padding-top: 6.5%">
                        <a class="padding-button-2" href="/guestMenu/checkOut"  style="text-decoration: none"  type="submit" >  <b class="p">Check Out</b>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </main>
</div>
</body>
