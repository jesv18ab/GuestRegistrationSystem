@extends('layouts.app')

@section('content')


    <header style="background-image:url({{ asset('/Images/light-Background.jpg') }});  background-size: cover; opacity: 0.9; display: block " ></header>
    <body id="body"  style=" display: block">

    <div  class="container2 shadow" style="border: 1px solid black;  margin-left: 15%; height: 500px; width: 1100px; margin-top: 7%; background-color: white" >
        <p class="text-Check-In">Vælg venligst Check ind eller check ud</p>
        <div id="inputBoxes" style=" padding-top: 5px; display: none">
         <div id="checkInOpen" class="search" style="display: none; border: 1px solid black">
        <input id="guestInputCheckIn" placeholder="Indtast dit navn her...." onkeyup="searchForGuest()" type="search" class="search-box" />
        <span class="search-button">
    <span class="search-icon"></span>
  </span>
        </div>
        <div id="checkOutOpen" class="search" style="display: none; margin-bottom: 0">
            <input id="guestInputCheckOut" placeholder="Indtast dit navn her...." onkeyup="searchForGuest()" type="search" class="search-box" />
            <span class="search-button">
    <span class="search-icon"></span>
  </span>
        </div>
    </div>
    <div id="checkButtons" class="checkInAndOut">
        <div class="btnGuests shadow ">  <a class="padding-button-2"  type="submit"   onclick="checkIn()"><p > <b class="p">Check in</b> </p> </a></div>
   <div class="btnGuests2 shadow">
       <div class="padding-button" style="padding-top: 6.5%"><a class="padding-button-2"   type="submit"   onclick="checkOut()">  <b class="p">Check Out</b> </a></div>
   </div>
   </div>
    <form id="executeCheckIn" method="POST" data-route="/guests/{{ $id ?? '' }}/{{ $guestCardId ?? '' }}" >
        @csrf
        @method('PUT')
        <div class="field" >
                            <div class="control" id="guestsCheckIn" style="display: none; height: 100%  " >
                                <div>
                                    <select class="custom-select" id="cardIsPicked" style="margin-left: 20%; margin-top: 2%; width: 25%; height: 70px; box-shadow: 0 0 0 0.2rem black; " required="required">
                                        <option value="" ><p >Vælg dit Id kort her....</p>
                                        </option>
                                        @foreach($cardsAvailable as $guestCard)
                                            <option value="{{ $guestCard->id }}">{{ $guestCard->id }}</option>
                                        @endforeach
                                    </select>
                                    <div id="searchIn2" style="float: right; margin-right: 1%; margin-top: 1%; height: 70px; width: 500px ">
                                        <table id="searchIn" class="table table-hover"  style="display: none; height: 100%; border-collapse: separate; border-spacing: 1em;">
                                            <tbody>
                                            @foreach($guests_Today_Check_In as $guest)
                                                <tr  style="width: 100%; height: 100%;" >
                                                    <td  class="shadow" id="{{ $guest->id }}" style="background-color: white; width: 75%; " > <h3 style="font-weight: 900; text-align: center; color: black; height: 20px  "> {{ $guest->name }} </h3></td>
                                                    <td  class="shadow-lg" style="background-color: #3490dc"><button class="btnBrew2 btnBrew-primary " style="width: 150px; height: 20px; border: 0px; padding: 0px" name="{{ $guest->id }}" type="submit" onclick="guest_Check_in('{{ $guest->id }}', this, '{{ $guest->name }}')" > <h3 style="margin-top: 1%" > <b style="color: black;  text-shadow: 0px 1px, 1px 0px, 1px 1px; font-weight: 300"> Check in</b></h3> </button></td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <p id="regsiteredTable" style="display: none"> <input  type="text" id="txtValue" /></p>
                         </div>
                        </div>
    </form>
    <div id="unexpected1" style="margin-top: 7%; width: 100%; display: none; text-align: center">
     <h2 style="color: black" > Er du ikke i systemet! Så tryk på knappen herunder</h2>
    <button type="button" class="btn-lg btn-primary" data-toggle="modal" data-target="#divForUnexpectedGuests" style="width: 45%; height: 45px; padding-top:6px ">
        <h3  > Opret dig her</h3>
    </button>
    </div>
        <form id="executeCheckOut" method="Post " data-route="/guests/{{ $guestId ?? '' }}/{{ $id ?? '' }}"; style="margin-left: 20%; " >
            @csrf
            @method("PUT")
            <div  id="guestsCheckOut" style="display: none">
                <div id="searchIn2" style="display: flex; height: 600px; width: 800px ">
                    <table id="searchOut" class="table table-hover"  style="display: none; height: 100%; width: 800px; border-collapse: separate; border-spacing: 1em;">
                        <thead>
                        <tr>
                            <th style="padding: 0px"><h3 style="font-weight: 900; text-align: left; color: black; margin: 0px  "> Name </h3></th>
                            <th style="padding: 0px"><h3 style="font-weight: 900; text-align: left; color: black; margin: 0px  "> Id kort </h3></th>
                        </tr>
                        </thead>
                        <tbody id="out_t_body">
                        @foreach($guests_Today_Check_Out as $checkOut )
                            <tr style="width: 100%; height: 100%; ">
                                <td style="background-color: white; width: 75%; box-shadow: 0 0 0 0.2rem black" > <h3 style="font-weight: 900; text-align: center; color: black  "> {{ $checkOut->name }} </h3></td>
                                <td style="background-color: white; width: 75%; box-shadow: 0 0 0 0.2rem black" > <h3 style="font-weight: 900; text-align: center; color: black  ">{{ $checkOut->id }}</h3></td>
                                <td ><button id="test1" type="submit"  class="btnBrew2 btnBrew-primary"style="width: 250px; height: 65px; border: 0px; padding: 0px" onclick="guest_Check_out( '{{$checkOut->guestId}}', '{{ $checkOut->id }}', this)"> <h3 style="margin-top: 1%" > <b style="color: white;  text-shadow: 0px 1px, 1px 0px, 1px 1px; font-weight: 300">Check Out</b></h3></button> </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </form>

<div class="modal fade" id="divForUnexpectedGuests" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  >
    <form id="form-data" method="post" data-route="/ajaxRequest/{{ $name ?? '' }}" action="/ajaxRequest/{{ $name ?? '' }}">
        @csrf
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #e3e3df">
                <h5 class="modal-title" id="exampleModalLabel">Hurtig oprettelse og check in</h5>
            </div>
            <div class="modal-body" style="padding-top: 5%; padding-right: 10%;padding-left: 10%; ">
                <p style="font-weight: bold"> Skriv venligst dit navn i feltet herunder og vælg dernæst dit gæstekort i mennuen</p>
                    <input id="unexpectedGuest" name="guestName"   class="input-group-text" placeholder="Indtast dit navn her.... "  type="text"  style="width: 80%; height: 70px;margin: auto; border: 1px #1b1e21; " >
                <p>
                    <select class="custom-select" id="cardIsPicked2" style="margin-left: 9%; margin-top: 5%; width: 60%; height: 40%" required="required">
                        <option value="">Vælg Id-kort herunder....</option>
                        @foreach($cardsAvailable as $guestCard)
                            <option value="{{ $guestCard->id }}">{{ $guestCard->id }}</option>
                        @endforeach
                    </select>
                </p>
                <p id="regsiteredTable" style="display: none"> <input  type="text" id="txtValue2" /></p>
            </div>
            <div class="modal-footer" style="padding-bottom: 5%; padding-top: 5%" >
                <button id="unexpectedGuestsBtn" class="btn btn-info btn-submit" style="width: 60%; height: 50%; display: block; margin: 0 auto"> <b> Opret! </b></button>
            </div>
        </div>
    </div>
    </form>
    <form id="form-data-Put" method="post" data-route="/ajaxRequest/{{ $id ?? '' }}/ {{ $card ?? '' }}/edit" action="/ajaxRequest/{{ $id ?? '' }}/ {{ $card ?? '' }}/edit" style="display: none">
        @csrf
        @method('PUT')
    </form>
</div>
</div>



<script  src="{{ asset('assets/js/ajaxCalls.js') }}" defer>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
    </body>





@endsection







