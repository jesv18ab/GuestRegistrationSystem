@extends('layouts.app')

@section('content')

    <div class="registrationContainer" >
        <div id="newGuests" class="guestRegistrationNewGuest">
            <form id="make_employee_form"  method="POST" class="shadow"  style="; border:1px solid #ccc; margin-top: 13%; padding-bottom: 20px; height: 550px;">
                @csrf
                <div class="paddingChecker2" style="background-color: #e3e3df; text-align: center; height: 12% ">
                    <h2 style="font-weight: 400; color: black">Opret en ny medarbejder</h2>
                </div>
                <div style="background-color: rgba(255, 253, 253, 0);">
                    <p class="paddingChecker2" style="font-size: large; margin-top: 0.5%; margin-bottom: 0.5%; color: black;font-weight: 500;">For at oprette en ny medarbejder, skal alle felter i formularen udfyldes</p>
                    <hr style="margin-top: 0.5%; margin-bottom: 0.5%; border-bottom: 1px solid black">
                    <div class="btn-group paddingChecker2" >
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             Medarbejdertype....
                        </button>

                        <div>
                        <input id="input_employee_position" name=""  class="input-group-text"  type="text"  style="width: 80%; height: 48px;margin: auto; border: 1px #1b1e21; display: none" readonly >
                        </div>
                        <div class="dropdown-menu dropdown-menu-right">
                            <button id="admin" class="dropdown-item" type="button" value="Administrator" onclick="transfer_info_employee(document.getElementById('admin').value)">Administrator</button>
                            <button id="other_employees" class="dropdown-item" type="button" value="Øvrige medarbejdere" onclick="transfer_info_employee(document.getElementById('other_employees').value)">Øvrige medarbejdere</button>
                        </div>
                    </div>

                    <div class="input-group paddingChecker2">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">Fornavn og efternavn</span>
                        </div>
                        <input type="text" class="form-control" name="firstname" placeholder="Skriv fornavn her....">
                        <input type="text" class="form-control" name="lastname" placeholder="Skriv efternavn her....">
                    </div>

                    <div class="input-group paddingChecker2">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">E-mail</span>
                        </div>
                        <input type="text" class="form-control" name="email" placeholder="Skriv E-mail her....">
                    </div>
                    <div class="input-group paddingChecker2">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">Opret et password</span>
                        </div>
                        <input type="text" class="form-control" name="password" placeholder="Skriv password her....">
                    </div>

                </div>
                <div style="border-bottom: 1px solid #1b1e21; margin-top: 1% ; margin-bottom: 1.5%"></div>
                    <div class="field is-grouped paddingChecker2">
                        <div class="control" style="margin-top: 1%; text-align: center">
                            <button  style="margin-bottom: 2.5%; width: 70%; height: 8%; background-color: #e3e3df; font-size: 1.4rem" type="submit" class="btn btn-success-2 shadow o" onclick="make_employee(document.getElementById('input_employee_position').value)">Opret medarbejder</button>
                        </div>
                    </div>
                <div style="border-bottom: 1px solid #1b1e21; margin-top: 1% ; margin-bottom: 1.5%"></div>
            </form>
        </div>





    </div>

    @endsection
