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
                <ul class="navbar-nav  navBarAmgros bg-cream" >
                    <li class="nav-item " >
                        <a class="nav-link font-navbar" style="font-size: x-large; padding-top: 16px; color: black" href="/guestMenu">
                            <i class='fas fa-home' style='font-size:54px'></i>                Gå til hovedmenuen
                        </a>
                    </li>
                </ul>
                <!-- Left Side Of Navbar -->
                <a class="navbar-brand right-margin "  style="margin-right: 4rem; margin-left: 18%">
                    <img src="../Images/logo.svg" height="74px" width="379px" >
                </a>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto navBarAmgros bg-cream" >
                    <!-- Authentication Links -->
                    <li class="nav-item " >
                        <a class="nav-link font-navbar" style="font-size: x-large; padding-top: 16px; color: black" href="/guestMenu/checkIn">Gå til check In
                            <i class='fas fa-house-user' style='font-size:54px'></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>



    <main class="py-4">

        <div  class="container2 shadow" style="border: 1px solid black;  margin-left: 15%; height: 500px; width: 1100px; margin-top: 7%; background-color: white" >
            <p class="text-Check-In">Indtast venligst dit navn i tekstfeltet </p>
            <div id="inputBoxes" style=" padding-top: 5px">
                <div class="input-group input-group-lg" style="width: 793px; margin-left: 14%; margin-top: 2%">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-lg"><i class='fas fa-search' style='font-size:40px'>
            </i></span>
                    </div>
                    <input id="guest_Input_CheckOut" placeholder="Indtast dit navn her...." onkeyup="searchForGuest_updated_out()" type="search" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" style="width: 50px; height: 87px">
                </div>
            </div>
            <form id="execute_Check_Out" method="POST"  >
                @csrf
                @method('PUT')
                <div class="field" >
                    <div class="control" style=" height: 100%  " >
                        <div>
                            <div id="searchIn2" style="float: right;  margin-top: 5.5%; height: 148px; width: 98%; max-height: 10rem ">
                                <table id="search_Out" class="guestTable2 supplementNav2"  style="width: 99%; margin-right: 17% ; border-spacing: 3px 15px; border-collapse: separate ">
                                    <thead>
                                    <tr>
                                        <th class="supplementNav3" style="background-color: white" ><h4>Navn</h4></th>
                                        <th class="supplementNav3 " style="background-color: white"><h4>Virksomhed</h4></th>
                                        <th class="supplementNav3" style="background-color: white"><h4>Gæstekort Id</h4></th>
                                        <th class="supplementNav3" style="background-color: white"><h4>Check out here</h4></th>
                                    </tr>
                                    </thead>
                                    <tbody id="search_Out_body" style="display: none; ">
                                    @foreach($guests_Today_Check_Out as $checkOut)
                                        <tr  style="width: 100%; height: 100%; background-color: white" >
                                            <td   id="{{ $checkOut->id }}" style="height: 75px; font-size: x-large " > <b style="color: black">  {{ $checkOut->name }} </b> </td>
                                            <td  > <b style="color: black; font-size: x-large">  {{ $checkOut->company }}  </b>  </td>
                                            <td  > <b style="color: black; font-size: x-large">  {{ $checkOut->id }}  </b>  </td>
                                            <td  style="width: 41%" ><button class="btn btn-secondary"  type="submit" style="width: 77%; height: 86%; text-align: center" formaction="checkOut/ {{ $checkOut->guestId }} / {{$checkOut->id}}"  >  Check Out </button></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <p id="regsiteredTable_new" style="display: none"> <input  type="text" id="txtValue_new" /></p>
                    </div>
                </div>
            </form>
        </div>
    </main>



</div>
</body>

