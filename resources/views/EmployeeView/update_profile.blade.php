@extends('layouts.app')

@section('content')

<div class="registrationContainer" >
    <div  class="guestRegistrationNewGuest">
        <form  method="POST" action="updateInfo/employee" class="shadow"  style="; border:1px solid #ccc; margin-top: 11%; padding-bottom: 20px; height: 600px;">
            @csrf
            @method('PUT')
            <div class="paddingChecker4" style="background-color: #e3e3df; text-align: center; height: 12% ">
                <h2 style="font-weight: 400; color: black">Opret en ny medarbejder</h2>
            </div>
            <div style="background-color: rgba(255, 253, 253, 0);">
                <p class="paddingChecker4" style="font-size: large; margin-top: 0.5%; margin-bottom: -1.6%; color: black;font-weight: 500;">For at oprette en ny medarbejder, skal alle felter i formularen udfyldes</p>
                </div>
                <div class="input-group paddingChecker4">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="">Navn</span>
                    </div>
                    <input type="text" class="form-control" name="name" value="{{ $currentUser->name }}" >
                </div>

                <div class="input-group paddingChecker4">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="">E-mail</span>
                    </div>
                    <input type="text" class="form-control" name="email" value="{{ $currentUser->email }}" >
                </div>
            <hr style="margin-top: 0.5%; margin-bottom: 0.5%; border-bottom: 1px solid black">
            <p class="paddingChecker4" style="font-size: large; margin-top: 0.5%; margin-bottom: 0.5%; color: black;font-weight: 500;">For at ændre password, skal du først indtaste dit tidligere password og derefter skrive dit nye password</p>
                <div class="input-group paddingChecker4">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="">Nuværende password</span>
                    </div>
                    <input type="password" class="form-control" placeholder="Skriv tidligere password her...." name="old_password" >
                </div>
                <div class="input-group paddingChecker4">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="">Nyt password</span>
                    </div>
                    <input type="password" class="form-control" placeholder="Skriv nyt password her......" name="new_password" >
                </div><div class="input-group paddingChecker4">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="">Gentag nyt password</span>
                    </div>
                    <input type="password" class="form-control" placeholder="Gentag password her....." name="new_password_repeat" >
                </div>
            <div style="border-bottom: 1px solid #1b1e21; margin-top: 1% ; "></div>
            <div class="field is-grouped paddingChecker4">
                <div class="control" style="margin-top: 1%; text-align: center">
                    <button   type="submit" class="btn btn-secondary" style="height: 50px; width: 51%" >Opdater</button>
                </div>
            </div>
        </form>
    </div>
</div>

    @endsection
