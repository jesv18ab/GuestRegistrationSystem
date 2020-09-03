@extends('layouts.app')

@section('content')



    @if(session()->has('notif'))
        <div id="messageBox" style="margin-top: 2%; height: 53px; position: absolute; z-index: 20">
        <div class="row" style="    text-align: center; width: 505px; margin-left: 111%; margin-top: 24%;">
            <div class="alert alert-success" style="width: 100%">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
               <b> <strong>Notifikation:</strong></b>
               <b> {{ session()->get('notif') }}</b>
            </div>
        </div>
        </div>

    @endif


<div class="registrationContainer">
        <div id="newGuests" class="guestRegistrationNewGuest" style="margin-top: 5%">
        <div class="shadow"  style="; border:1px solid #ccc; padding-bottom: 20px; height: 565px;">
<div>

    <form method="POST" action="/guests" >
        @csrf
                <div class="paddingChecker" style="background-color: #e3e3df; text-align: center ">
            <h1 style="font-weight: 400; color: black">Aftal nyt møde</h1>
                </div>
                <div style="background-color: rgba(255, 253, 253, 0);">
                <p class="paddingChecker" style="font-size: large; margin-top: 0.5%; margin-bottom: 0.5%; color: black;font-weight: 500;">Udfyld venligst nedenstående formular, for at registrere en kommende besøgsperson</p>
            <hr style="margin-top: 0.5%; margin-bottom: 0.5%">
            <div class="paddingChecker">
                <div class="input-group paddingChecker4">
                    <div class="input-group-prepend">
                        <span class="input-group-text" > Gæstens navn</span>
                    </div>
                    <input type="text" class="form-control @error('name')  is-invalid @enderror " placeholder="Indtast navn" name="name" value="{{ old('name') }}"  >
                   @error('name')
                    <p class=" is-invalid" style="color: red"> Dette felt skal udfyldes korrekt</p>
                    @enderror
                </div>

            </div>
                    <div class="paddingChecker">
                        <div class="input-group paddingChecker4">
                            <div class="input-group-prepend">
                                <span class="input-group-text" >Gæstens arbejdsplads</span>
                            </div>
                            <input type="text" class="form-control  @error('company')  is-invalid @enderror " placeholder="Indtast virksomheds her" name="company" value="{{ old('company') }}"  >
                            @error('company')
                            <p class=" is-invalid" style="color: red"> {{ $errors->first('company') }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="paddingChecker" style="height: 92px">
                        <div class="input-group paddingChecker4" >
                            <div class="input-group-prepend">
                                <span class="input-group-text" >Indtast tid og dato for møde</span>
                            </div>
                            <input class="@error('created_at') is-invalid @enderror "  type="date" for="created_at" name="created_at" value="{{ old('created_at') }}" style="width: 250px; height: 40px">
                            <input class="@error('time')  is-invalid @enderror " type="time" for="time" name="time" value="{{ old('time') }}" style="height: 40px">
                         @if($errors->has('created_at') && $errors->has('time') )
                                <p class="  is-invalid" style="color: red">Husk dato og tidspunkt for mødet</p>
                             @elseif($errors->has('created_at'))
                                <p class="  is-invalid" style="color: red">{{ $errors->first('created_at') }}</p>
                            @elseif($errors->has('time'))
                                <p class="  is-invalid" style="color: red">{{ $errors->first('time') }}</p>
                            @endif
                        </div>
                    </div>

            <div class="paddingChecker" style="padding-bottom: 0; padding-top: 0" >

            </div>
                    <div class="control" style=" text-align: center">

                        <button class="btn btn-secondary" style="height: 50px; width: 51%"  type="submit" >registrer</button>

                    </div>

    </form>
                </div>
<div class="field is-grouped paddingChecker">


    <div style="border-bottom: 1px solid #1b1e21; margin-top: 3% ; margin-bottom: 1.5%"></div>

    <div style="margin: auto; text-align: center">
        <form method="get" action="/rebook">
            @csrf
        <h3 style="color: black">Aftal et nyt møde med en tidligere gæst</h3>
        <button   class="btn btn-secondary" style="height: 50px; width: 51%" type="submit" > Book her </button>
        </form>
    </div>
        </div>
                </div>
        </div>
        </div>

</div>

    <script>
        /*Succes besked skal fade ud*/
        setTimeout(function () {
                if ($('#messageBox').length){
                    $('#messageBox').fadeOut()
                }
            }
            ,3000);
    </script>
@endsection
