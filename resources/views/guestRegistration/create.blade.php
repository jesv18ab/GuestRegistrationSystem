@extends('layouts.app')

@section('content')
<div class="registrationContainer">

        <div id="newGuests" class="guestRegistrationNewGuest">
            <form method="POST" action="/guests" class="shadow"  style="border:1px solid #ccc; margin-top: 2%; padding-bottom: 20px; height: 600px;">
                @csrf
                <div class="paddingChecker" style="background-color: #e3e3df; text-align: center ">
            <h1 style="font-weight: 400; color: black">Aftal nyt møde</h1>
                </div>
                <div style="background-color: rgba(255, 253, 253, 0);">
                <p class="paddingChecker" style="font-size: large; margin-top: 2%; color: black;font-weight: 700;">Udfyld venligst nedenstående formular, for at registrere en kommende besøgsperson</p>
            <hr>
            <div class="paddingChecker">
                <label for="name" style="color: black"><h5><b>Navn på person</b></h5></label>
            <input class="form-control" type="text" placeholder="Indtast navn" name="name" style="border: 2px solid #ced4da; height: calc(1.6em + 0.75rem + 12px);"  required>
            </div>

            <div class="paddingChecker" style="padding-bottom: 0; margin-top: 3% ">
                <label align="center" for="expected_at" style="color: black;  height: 35px; margin-bottom: 0"><h5 style="margin-bottom: 0"><b>Indtast tid og dato for møde</b></h5></label>
                </div>
            <div class="paddingChecker" style="padding-bottom: 0; padding-top: 0" >
                <input type="date" for="expected_at" name="expected_at" style="width: 250px; height: 40px">
                <input type="time" for="time" name="time" style="height: 40px">
            </div>
<div class="field is-grouped paddingChecker">
            <div class="control" style="margin-top: 2%; text-align: center">
                <button  style="margin-bottom: 3%; width: 70%; height: 8%; background-color: #e3e3df; font-size: 1.4rem" type="submit" class="btn btn-success-2 shadow o">registrer</button>
            </div>
    <div style="border-bottom: 1px solid #1b1e21; margin-top: 1% ; margin-bottom: 4%"></div>
    <div style="margin: auto; text-align: center">
        <h3 style="color: black">Aftal et nyt møde tidligere gæst</h3>
        <button  class="btn btn-success-2 shadow" style="margin: auto; width: 70%; height: 8%; background-color: #e3e3df; font-size: 1.4rem" type="button" onclick="reBooK()" > Book her </button>
    </div>
        </div>
                </div>
    </form>
        </div>

    <div id="formerGuests" class="guestRegistration" style="display: none">

        <form id="formNewBooking" method="POST" action="/guests"  style="border:1px solid #ccc">
            @csrf
            @method("PUT")
            <h1>Aftal nyt møde</h1>
            <p>Udfyld venligst nedenstående form ular, for at registrere en kommende besøgsperson.</p>
            <hr>

            <div>
                <label for="name"><h5><b>Navn</b></h5></label>
                <input class="form-control" type="text" name="name" id="nameInput" required>
                <input class="form-control" type="text" name="idOfGuest" id="guestId" style="display: block" required>
            </div>

            <div>
                <label align="center" for="expected_at"><h5><b>Indtast tid og dato for møde</b></h5></label>
            </div>
            <div  >
                <input type="date" for="expected_at" name="expected_at">
                <input type="time" for="time" name="time">
            </div>
            <p >By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>
            <div class="field is-grouped">
                <div class="control">
                    <button type="submit" class="btn btn-primary" onclick="executeBooking()">registrer</button>
                </div>

                </div>
        </form>
    </div>
    <div id="formerGuestsTable" style="display:none;" class="guestRegistrationSecond">
        <form style="alignment: center; margin-left: 20%" >
            <h3> Tidligere gæst? Find gæsten herunder</h3>
            <input class="input-group-text" type="text" id="searchForGuest" style="margin: 1%; place-self: center" onkeyup="findGuest()" placeholder="Søg efter gæst her.." title="Type in a name" />
            <div class="table-wrapper-scroll-y my-custom-scrollbar" >
                <form>
            <table class="createTabletable createTable-striped table-bordered table-sm" id="searcGuests"   >
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Sidste besøg</th>
                    <th scope="col">Vælg her</th>
                </tr>
                </thead>
                <tbody >

                @foreach($earlierGuests as $guest )
                    <tr>
                        <td>{{ $guest->name }}</td>
                        <td> {{ $guest->created_at }} </td>
                        <td><button type="button" id="retreiveName" class="btn btn-primary" onclick="setName('{{$guest->name}}', '{{ $guest->id }}')" > Check in </button></td>
                    </tr>
                @endforeach

                </tbody>

            </table>
                </form>
            </div>

        </form>
    </div>





@endsection
