@extends('layouts.app')

@section('content')

    <div class="registrationContainer">

    <div id="formerGuests_container" class="container2" style=" height: 590px" >
        <div id="formerGuests" class="guestRegistration shadow margin-Buttons" style="margin-top: 7%; height: 490px; width: 40%" >

            <form id="formNewBooking" method="POST" action="/rebook/rebookGuest" style="height: 500px"  >
                @csrf
                @method("PUT")
                <h1 class="bg-cream paddingChecker" style="text-align:center; font-weight: 400; color: black">Aftal nyt møde</h1>
                <p class="paddingChecker" style="font-size: large; margin-top: 0.5%; margin-bottom: 0.5%; color: black;font-weight: 500;">Udfyld venligst nedenstående formular, for at registrere en kommende besøgsperson.</p>
                <hr>
                <div class="paddingChecker" >
                    <div class="input-group paddingChecker4">
                        <div class="input-group-prepend">
                            <span class="input-group-text" >Gæstens navn</span>
                        </div>
                        <input type="text" class="form-control @error('name')  is-invalid @enderror" id="nameInput" name="name" value="{{ old('name') }}"  >
                        <input class="form-control" type="text" name="idOfGuest" id="guestId" style="display: none;" >
                        @if($errors->has('name')  )
                            <p class="  is-invalid" style="color: red"> Dette felt skal udfyldes korrekt</p>
                        @endif
                    </div>


                </div>

                <div class="paddingChecker">
                    <div class="input-group paddingChecker4">
                        <div class="input-group-prepend">
                            <span class="input-group-text" >Gæstens arbejdsplads</span>
                        </div>
                        <input id="company" name="company" type="text" class="form-control @error('company')  is-invalid @enderror" id="nameInput" name="name" value="{{ old('company') }}"  name="company"  >
                        @if($errors->has('company')  )
                            <p class="  is-invalid" style="color: red"> Dette felt skal udfyldes korrekt</p>
                        @endif
                    </div>
                </div>

                <div class="paddingChecker" style="height: 102.6302px;">
                    <div class="input-group paddingChecker4">
                        <div class="input-group-prepend">
                            <span class="input-group-text" >Indtast tid og dato for møde</span>
                        </div>
                        <input class="@error('created_at') is-invalid @enderror" type="date" for="created_at" name="created_at" style="width: 250px; height: 40px" value="{{ old('created_at') }}">
                        <input class="@error('time')  is-invalid @enderror " type="time" for="time" name="time" style="height: 40px" value="{{ old('time') }}">
                        @if($errors->has('created_at') && $errors->has('time') )
                            <p class="  is-invalid" style="color: red">Husk dato og tidspunkt </p>
                        @elseif($errors->has('created_at'))
                            <p class="  is-invalid" style="color: red">Dato skal udfyldes</p>
                        @elseif($errors->has('time'))
                            <p class="  is-invalid" style="color: red">Tidspunkt skal  angives</p>
                        @endif</div>
                </div>
                <div class="field is-grouped" style="text-align: center">
                    <div class="control">
                        <button class="btn btn-secondary" style="height: 50px; width: 51%" type="submit" onclick="execute_rebook()" > Registrer </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="headlineDiv" style="margin-top: 7%; margin-right: 1%; width: 52%">
            <h2 style="color: black" > Tidligere gæst? Find gæsten herunder</h2>
        </div>
        <div>
            <i class='fas fa-search' style='font-size:40px; margin-left: 2%;'>
            </i>
            <input class="input-group-text" type="text" id="searchForGuest" style="margin: 1%; place-self: center; width: 48%; height: 50px; float: right; width: 36%; margin-right: 14%; margin-left: 0%; margin-bottom: 0%; margin-top: 0%" onkeyup="findGuest_create_from()" placeholder="Søg efter gæst her.." title="Type in a name" />
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
                                        <td class="shadow bg-cream" ><button id="retreiveName" type="button"  class="btn btn-light shadow" style="width: 250px; height: 100%; border: 0px;" onclick="setName('{{$guest->name}}', '{{ $guest->id }}', '{{ $guest->company }}')"> <h3 style="margin-top: 1%" > <b style="color: black ;   font-weight: 300">Vælg</b></h3></button> </td>
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
