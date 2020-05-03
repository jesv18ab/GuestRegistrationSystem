<!--Here we get our title name and load js and css -->
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
            <ul class="navbar-nav  navBarAmgros bg-cream" >
               <li class="nav-item " >
            <a class="nav-link font-navbar" style="font-size: x-large; padding-top: 16px; color: black" href="/guestMenu">
                <i class='fas fa-home' style='font-size:54px'></i>                Gå til hovedmenuen
            </a>
               </li>
            </ul>
            <a class="navbar-brand right-margin "  style="margin-right: 4rem; margin-left: 18%;">
                <img src="../Images/logo.svg" height="74px" width="379px" >
            </a>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto navBarAmgros bg-cream" >
                <!-- Authentication Links -->



                <li class="nav-item " >
                    <a class="nav-link font-navbar" style="font-size: x-large; padding-top: 16px; color: black" href="/guestMenu/checkOut">Gå til check Out
                        <i class='fas fa-running' style='font-size:54px'></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

    <main class="py-4">
        <div  class="container2 shadow" style="border: 1px solid black;  margin-left: 15%; height: 500px; width: 1100px; margin-top: 7%; background-color: white" >
            <p class="text-Check-In">Indtast venligst dit navn i tekstfeltet </p>
            <div id="inputBoxes" style=" padding-top: 5px; ">

                <div class="input-group input-group-lg" style="width: 793px; margin-left: 14%; margin-top: 2%">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-lg"><i class='fas fa-search' style='font-size:40px'>
            </i></span>
                    </div>
                    <input id="guest_Input_CheckIn" placeholder="Indtast dit navn her...." onkeyup="searchForGuest_updated()" type="search" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" style="width: 50px; height: 87px">
                </div>
            </div>

            <form id="execute_Check_In" method="POST" action="/guests"  >
                @csrf
                @method('PUT')
                <div class="field" >
                    <div class="control" style=" height: 100%  " >
                        <div>
                            <select class="custom-select" id="cardIsPicked_new" style="margin-left: 10%; margin-top: 2%; width: 25%; height: 70px; box-shadow: 0 0 0 0.2rem black; " required="required">
                                <option value="" ><p >Vælg dit Id kort her....</p>
                                </option>
                                @foreach($cardsAvailable as $guestCard)
                                    <option name="card" id="{{ $guestCard->id }}" value="{{ $guestCard->id }}">{{ $guestCard->id }}</option>
                                @endforeach
                            </select>
                            <div id="searchIn2" style="float: right; margin-right: 1%; margin-top: 1.5%; height: 95px; width: 626px ">
                                <table id="search_In" class="guestTable2 supplementNav2"  style="display: none; width: 100%; ">
                                    <tbody>
                                    @foreach($guests_Today_Check_In as $guest)
                                        <tr  style="width: 100%; height: 100%;" >
                                            <td   id="{{ $guest->id }}" style="height: 75px; font-size: x-large " > <b style="color: black">  {{ $guest->name }} </b> </td>
                                            <td  > <b style="color: black; font-size: x-large">  {{ $guest->company }}  </b>  </td>
                                            <td  style="width: 41%" ><button class="btn btn-secondary"  type="submit" style="width: 92%; height: 75%" onclick= "check_in_guest( '{{ $guest->id }}')" >  Check in </button></td>
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
            <div id="unexpected1" style="margin-top: 4%; width: 100%;  text-align: center">
                <h2 style="color: black; border-top: 1px solid black; padding-top: 2%" > Er du ikke i systemet! Så tryk på knappen herunder</h2>
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#div_For_Unexpected_Guests" style="width: 47%; height: 59px; padding-top:6px ">
                    <p style="font-size: x-large"> Opret dig her</p>
                </button>
            </div>
        </div>

        <div class="modal fade" id="div_For_Unexpected_Guests" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="height: 110%"  >
            <form id="form-data-create" method="post" data-route="/fastCreate"   style="width: 39%;    margin-left: 26%; height: 73%  ">
                @csrf
                <div class="modal-dialog" role="document" style="height: 100%" >
                    <div class="modal-content" style="height: 92%; width: 143%">
                        <div class="modal-header" style="background-color: #e3e3df">
                            <h3 class="modal-title" id="exampleModalLabel" style=" text-align: center; margin-left: 26%; color: black ">Hurtig oprettelse og check in</h3>
                        </div>
                        <div class="modal-body" style="padding-top: 5%; padding-right: 4%;padding-left: 1%; ">
                            <p style="color: black; font-size: larger"> Udfyld venligst alle felter i formularen, og afslut ved at trykke på "Opret og check in"</p>
                            <div class="input-group paddingChecker2">
                                <div class="input-group-prepend" style="height: 60px">
                                    <span class="input-group-text" id="">Navn</span>
                                </div>
                                <input id="unexpected_Guest" name="guestName"   class="form-control" placeholder="Indtast dit navn her.... "  type="text" style="height: 60px"   >
                            </div>
                            <div class="input-group paddingChecker2">
                                <div class="input-group-prepend" style="height: 60px">
                                    <span class="input-group-text" id="">Skriv venligst din arbejdsplads</span>
                                </div>
                                <input id="unexpectedGuest_company" name="company"  class="form-control" placeholder="Indtast din arbejdsplads/uddannelsessted/andet her.... "  type="text" style="height: 60px"   >
                            </div>
                            <p>
                                <select name="cardPicked" class="custom-select" id="cardIsPicked_create" style="margin-left: 2%; margin-top: 2%; width: 60%; height: 60px" required="required">
                                    <option value="">Vælg Id-kort herunder....</option>
                                    @foreach($cardsAvailable as $guestCard)
                                        <option name="card" value="{{ $guestCard->id }}">{{ $guestCard->id }}</option>
                                    @endforeach
                                </select>
                            </p>
                            <button id="unexpected_Guests_Btn"  class="btn-lg btn-secondary"  style="width: 350px; height: 61px; margin-left: 26%; margin-top: 5%" onclick="create_and_check_in()" >  Opret og check in! </button>
                        </div>
                    </div>
                </div>
            </form>
            <form id="form-data-update" method="post" data-route="/fastupdate/{{ $card ?? ''}}/{{ $id ?? ''}}" action="/fastupdate/{{ $card ?? ''}}/{{ $id ?? ''}}" style="display: none">
                @csrf
                @method('PUT')
            </form>

        </div>
    </main>


</div>
</body>


