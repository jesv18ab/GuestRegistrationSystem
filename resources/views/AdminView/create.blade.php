@extends('layouts.app')

@section('content')
<div class="registrationContainer">

        <div id="newGuests" class="guestRegistrationNewGuest">
            <form method="POST" action="/guests" class="shadow"  style="; border:1px solid #ccc; margin-top: 13%; padding-bottom: 20px; height: 550px;">
                @csrf
                <div class="paddingChecker" style="background-color: #e3e3df; text-align: center ">
            <h1 style="font-weight: 400; color: black">Aftal nyt møde</h1>
                </div>
                <div style="background-color: rgba(255, 253, 253, 0);">
                <p class="paddingChecker" style="font-size: large; margin-top: 0.5%; margin-bottom: 0.5%; color: black;font-weight: 500;">Udfyld venligst nedenstående formular, for at registrere en kommende besøgsperson</p>
            <hr style="margin-top: 0.5%; margin-bottom: 0.5%">
            <div class="paddingChecker">
                <label for="name" style="color: black"><h5><u>Navn på person</u></h5></label>
            <input class="form-control" type="text" placeholder="Indtast navn" name="name" style="border: 2px solid #ced4da; height: calc(1.6em + 0.75rem + 12px);"  required>
            </div>

            <div class="paddingChecker" style="padding-bottom: 0; margin-top: 1% ">
                <label align="center" for="created_at" style="color: black;  height: 35px; margin-bottom: 0"><h5 style="margin-bottom: 0"><u>Indtast tid og dato for møde</u></h5></label>
                </div>
            <div class="paddingChecker" style="padding-bottom: 0; padding-top: 0" >
                <input type="date" for="created_at" name="created_at" style="width: 250px; height: 40px">
                <input type="time" for="time" name="time" style="height: 40px">
            </div>
<div class="field is-grouped paddingChecker">
            <div class="control" style="margin-top: 1%; text-align: center">
                <button  style="margin-bottom: 2.5%; width: 70%; height: 8%; background-color: #e3e3df; font-size: 1.4rem" type="submit" class="btn btn-success-2 shadow o">registrer</button>
            </div>
    <div style="border-bottom: 1px solid #1b1e21; margin-top: 1% ; margin-bottom: 1.5%"></div>
    <div style="margin: auto; text-align: center">
        <h3 style="color: black">Aftal et nyt møde med en tidligere gæst</h3>
        <button  class="btn btn-success-2 shadow" style="margin: auto; width: 70%; height: 8%; background-color: #e3e3df; font-size: 1.4rem" type="button" onclick="reBooK()" > Book her </button>
    </div>
        </div>
                </div>
    </form>
        </div>

    <div id="formerGuests_container" class="container2" style="display: none; height: 590px" >
    <div id="formerGuests" class="guestRegistration shadow margin-Buttons" style="margin-top: 7%; height: 450px; width: 40%" >
        <form id="formNewBooking" method="POST" action="/guests"  style="">
            @csrf
            @method("PUT")
            <h1 class="bg-cream paddingChecker" style="text-align:center; font-weight: 400; color: black">Aftal nyt møde</h1>
            <p class="paddingChecker" style="font-size: large; margin-top: 0.5%; margin-bottom: 0.5%; color: black;font-weight: 500;">Udfyld venligst nedenstående form ular, for at registrere en kommende besøgsperson.</p>
            <hr>

            <div>
                <label for="name" style="color: black; margin-left: 2%"><h5><u>Navn på person</u></h5></label>
                <input class="form-control" type="text" id="nameInput" placeholder="Indtast navn" name="name" style="margin-left: 2%; margin-bottom: 2%; border: 2px solid #ced4da; height: calc(1.6em + 0.75rem + 12px); width: 80%"  required>
                <input class="form-control" type="text" name="idOfGuest" id="guestId" style="display: none;" required>
            </div>

            <div>
                <label align="center" for="created_at" style="color: black;  height: 35px; margin-bottom: 0; margin-left: 2%"><h5 style="margin-bottom: 0"><u>Indtast tid og dato for møde</u></h5></label>
            </div>
            <div style="margin-left: 2%; margin-bottom: 3%" >
                <input type="date" for="created_at" name="created_at" style="width: 250px; height: 40px">
                <input type="time" for="time" name="time" style="height: 40px">
            </div>
            <div class="field is-grouped" style="text-align: center">
                <div class="control">
                    <button  class="btn btn-success-2 shadow" style="margin: auto; width: 70%; height: 8%; background-color: #e3e3df; font-size: 1.4rem" type="submit" onclick="executeBooking()" > Registrer </button>
                </div>
                </div>
        </form>
    </div>
        <div class="headlineDiv" style="margin-top: 7%; margin-right: 1%; width: 52%">
            <h2 > Tidligere gæst? Find gæsten herunder</h2>
        </div>
        <div>
        <i class='fas fa-search' style='font-size:40px; margin-left: 2%;'>
        </i>
            <input class="input-group-text" type="text" id="searchForGuest" style="margin: 1%; place-self: center; width: 48%; height: 50px; float: right; width: 36%; margin-right: 14%; margin-left: 0%; margin-bottom: 0%; margin-top: 0%" onkeyup="findGuest()" placeholder="Søg efter gæst her.." title="Type in a name" />
        </div>
        <div class="tablesDiv4 shadow" id="check_in" style=" height: 20rem; width: 52%; margin-top: 1%">
            <div class="tablesDiv3 " style="height: 20rem" >
        <form style="alignment: center" >
            <h3> </h3>
                <form>
                    <div id="searchIn3" style="display: flex; height: 600px; width: 800px ">
                        <table id="searchGuest_create" class="guestTable2 supplementNav2"  style="height: 0%; width: 800px; border-collapse: separate; border-spacing: 1em;">
                            <thead>
                            <tr>
                                <th class="supplementNav3"><h4>Navn</h4></th>
                                <th class="supplementNav3"><h4>Sidste besøg</h4></th>
                                <th class="supplementNav3"><h4>Vælg person</h4></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($earlierGuests as $guest )
                                <tr  style="width: 100%;  ">
                                    <td class="shadow " style="background-color: white; width: 75%; height: 1%" > <h5 style="font-weight: 900; text-align: center; color: black  "> {{ $guest->name }} </h5></td>
                                    <td class="shadow" style="background-color: white; width: 75%; height: 5% " > <h5 style="font-weight: 900; text-align: center; color: black  ">{{ $guest->created_at }}</h5></td>
                                    <td class="shadow bg-cream" ><button id="retreiveName" type="button"  class="btn btn-light shadow" style="width: 250px; height: 100%; border: 0px;" onclick="setName('{{$guest->name}}', '{{ $guest->id }}')"> <h3 style="margin-top: 1%" > <b style="color: black ;   font-weight: 300">Vælg</b></h3></button> </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
        </form>

            </div>
        </div>
    </div>



</div>
@endsection
