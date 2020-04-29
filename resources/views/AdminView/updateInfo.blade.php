@extends('layouts.app')

@section('content')


    <div class="registrationContainer">
        <div class="headlineDiv">
            <h2 id="change_info_empployee"> opdater medarbejder oplysninger</h2>
            <h2 id="remove_employee" style="display: none"> Fjern ansat</h2>
            <h2 id="change_info_guest" style="display: none"> Opdater gæsteoplysninger</h2>
            <h2 id="remove_guest" style="display: none" > Fjern gæst</h2>
        </div>
        <div class="tablesDiv4 shadow" id="check_in" style=" height: 30rem">
            <div class="tablesDiv3 " >
            <table id="change_employee"  class="guestTable2 supplementNav2"  align="center" style=" width: 100%; display: table; " value="true" >
                    <thead>
                    <tr>
                        <th class="supplementNav3" ><h4>Navn</h4></th>
                        <th class="supplementNav3"><h4>E-mail</h4></th>
                        <th class="supplementNav3"><h4>Vælg her</h4></th>
                    </tr>
                    </thead>
                    <tbody id="">
                    @foreach($employees as $employee)
                        <tr >
                            <td   style="height: 75px; " >{{$employee->name}}</td>
                            <td > {{$employee->email}}</td>
                            <td ><button   class="btn btn-light shadow"  type="submit" style="width: 200px; height: 50px; padding-left: 3%" data-toggle="modal" data-target="#change_employee_info_div" onclick="transfer_data_employee('{{ $employee->id }}', '{{ $employee->name }}', '{{ $employee->email }}', '{{ $employee->password }}', 1)"  >Ændre</button>
                            </td>                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <table id="delete_employee"  class="guestTable2 supplementNav2"  align="center" style=" width: 100%; display: none; " value="true" >
                    <thead>
                    <tr>
                        <th class="supplementNav3" ><h4>Navn</h4></th>
                        <th class="supplementNav3"><h4>E-mail</h4></th>
                        <th class="supplementNav3"><h4>Vælg her</h4></th>
                    </tr>
                    </thead>
                    <tbody id="">
                    @foreach($employees as $employee)
                        <tr  >
                            <td   style="height: 75px; " >{{$employee->name}}</td>
                            <td > {{$employee->email}}</td>
                            <td ><button id=""  class="btn btn-light shadow"  type="submit" style="width: 200px; height: 50px; padding-left: 3%" data-toggle="modal" data-target="#delete_employee_div" onclick="transfer_data_employee('{{ $employee->id }}', '{{ $employee->name }}', '{{ $employee->email }}', '{{ $employee->password }}', 2)"  >Ophør medarbejer </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <table id="change_guest"  class="guestTable2 supplementNav2"  align="center" style=" width: 100%; display: none; " value="true" >
                    <thead>
                    <tr>
                        <th class="supplementNav3" ><h4>Personer valgt/Ikke valgt</h4></th>
                        <th class="supplementNav3"><h4>Name</h4></th>
                        <th class="supplementNav3"><h4>Ankomst klokken</h4></th>

                    </tr>
                    </thead>
                    <tbody id="">
                    @foreach($guests as $guest)
                        <tr  >
                            <td   style="height: 75px; " >{{$guest->name}}</td>
                            <td > {{$guest->company}}</td>
                            <td ><button  class="btn btn-light shadow"  type="submit" style="width: 200px; height: 50px; padding-left: 3%" data-toggle="modal" data-target="#change_guest_info_div" onclick="transfer_data_guest('{{$guest->id}}', '{{ $guest->name }}', '{{ $guest->company }}', 1 )"  >Ændre</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <table id="delete_guest"  class="guestTable2 supplementNav2"  align="center" style=" width: 100%; display: none; " value="true" >
                    <thead>
                    <tr>
                        <th class="supplementNav3" ><h4>Navn</h4></th>
                        <th class="supplementNav3"><h4>Virksomhed</h4></th>
                        <th class="supplementNav3"><h4>Vælg her</h4></th>
                    </tr>
                    </thead>
                    <tbody id="">
                    @foreach($guests as $guest)
                        <tr  >
                            <td   style="height: 75px; " >{{$guest->name}}</td>
                            <td > {{$guest->company}}</td>
                            <td ><button id=""  class="btn btn-light shadow"  type="submit" style="width: 200px; height: 50px; padding-left: 3%" data-toggle="modal" data-target="#delete_guest_div" onclick="transfer_data_guest('{{$guest->id}}', '{{ $guest->name }}', '{{ $guest->company }}', 2 )"  >Slet denne gæst</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
        </div>
        </div>

        <div class="modal fade" id="change_employee_info_div"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="height: 110%">
            <form id="form-data_change_info_employee" method="post" action="/updateInfo/users"  style="width: 39%;    margin-left: 26%;  ">
                @csrf
                @method('PUT')
                <div class="modal-dialog" role="document" style="height: 89%">
                    <div class="modal-content" style="height: 92%; width: 143%">
                        <div class="modal-header" style="background-color: #e3e3df">
                            <i class='fas fa-address-card' style='font-size:36px'></i>
                            <h3 class="modal-title" id="exampleModalLabel " style="text-align: center; margin-left: 28%; font-weight: 800">Ændringsdokument</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h4 style="font-weight: bold; padding-bottom: 2%; border-bottom: 1px solid black"> Skriv i de felter, du ønsker at ændre oplysninger og afslut ved at trykke på knappen "Afslut"</h4>

                                <u style="font-size: larger; font-weight: 600">Navn på arbejder</u>
                                <input id="name_employee_field" name="employeeName"   class="input-group-text"   type="text"  style="width: 100%; height: 51px; border: 1px #1b1e21;margin-top: 1.5% " >

                                <u style="font-size: larger; font-weight: 600">E-mail</u>
                                <input id="email_employee_field" name="employeeEmail"   class="input-group-text"   type="text"  style="width: 100%; height: 51px; border: 1px #1b1e21; margin-top: 1.5% " >

                            <u style="font-size: larger; font-weight: 600">Password</u>
                            <input id="password_employee_field" name="employeePassword"   class="input-group-text"   type="password"  style="width: 100%; height: 51px; border: 1px #1b1e21; margin-top: 1.5% " >
                            <input type="checkbox" onclick="showPassword()">Show Password
                            <input id="id_of_employee" name="employeeId"   class="input-group-text"   type="text"  style="display: none" >
                            <input  class="input-group-text"   type="text" value="1" name="type"  style="display: none" >

                        </div>
                        <div class="modal-footer" style="height: 97px">
                            <button type="submit" id="unexpectedGuestsBtn" class="btn btn-info btn-submit" style="width: 61%; height: 79%; margin-right: 20%; padding: 1% ">Gem ændringerne</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="modal fade" id="change_guest_info_div"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="height: 110%">
            <form id="form-data_change_guest_info" method="post" action="/updateInfo/users"  style="width: 39%;    margin-left: 26%;  margin-top: 5%;">
                @csrf
                @method('PUT')
                <div class="modal-dialog" role="document" style="height: 89%">
                    <div class="modal-content" style="height: 92%; width: 143%">
                        <div class="modal-header" style="background-color: #e3e3df">
                            <i class='fas fa-address-card' style='font-size:36px'></i>
                            <h3 class="modal-title" id="exampleModalLabel " style="text-align: center; margin-left: 28%; font-weight: 800">Ændringsdokument</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h4 style="font-weight: bold; padding-bottom: 2%; border-bottom: 1px solid black"> Skriv i de felter, du ønsker at ændre oplysninger og afslut ved at trykke på knappen "Afslut"</h4>
                            <p>
                                <u style="font-size: larger; font-weight: 600">Navn på gæst</u>
                                <input id="guest_name_field" name="guestName"   class="input-group-text"   type="text"  style="width: 100%; height: 51px; border: 1px #1b1e21;margin-top: 1.5% " >
                            <p>

                            <p>
                                <u style="font-size: larger; font-weight: 600">Gæstens arbejdsplads/uddannelsessted</u>
                                <input id="guest_company_field" name="guestCompany"   class="input-group-text"   type="text"  style="width: 100%; height: 51px; border: 1px #1b1e21; margin-top: 1.5% " >

                            <p>
                            <p id="regsiteredTable" style="display: none"> <input  type="text" id="txtValue2" /></p>
                            <input id="id_of_guest_to_change" name="guestId"   class="input-group-text"   type="text"  style="display: none" >
                            <input  class="input-group-text"   type="text" value="2" name="type"  style="display: none" >

                        </div>
                        <div class="modal-footer" style="height: 97px">
                            <button type="submit" id="unexpectedGuestsBtn" class="btn btn-info btn-submit" style="width: 61%; height: 79%; margin-right: 20%; padding: 1% ">Gem ændringerne</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>


        <div class="vertical-nav-brew bg-white" id="sidebar" style="height: 570px; margin-left: 4%; margin-top: 6% ">
            <p class="text-black-brew font-weight-bold text-uppercase-brew px-3 col-sm mb-0 paddingChecker" style=" text-align: center;   color: black; font-size: 20px;">Oversigt</p>
            <div class="filterDiv">
                <div id="guest-Input-Div" class="input-group" style="width: 450px">
            <span class="input-group-addon">  <i class='fas fa-search' style='font-size:40px'>
            </i></span>
                    <input class="form-control"  type="text" id="input-box" onkeyup="findGuests()"  placeholder="Find gæst her.." title="Type in a name" style="margin-bottom: 3%; height: 50px" >
                </div>
            </div>

            <p class="text-gray-brew font-weight-bold text-uppercase-brew px-3 small mb-0 paddingChecker" style=" font-size: 18px">Medarbejdere</p>
            <ul class="nav flex-column bg-white mb-0 supplementNav">
                <li class="nav-item">
                    <a type="button" onclick="sort_update_page(1) " class="nav-link text-dark font-italic bg-light">
                        <i class='fas fa-clipboard-list' style='font-size:25px'></i>
                        Ændring af medarbejder
                    </a>

                </li>
                <li class="nav-item">
                    <a type="button" onclick="arrived_today()" class="nav-link text-dark font-italic bg-light">
                        <i class='fas fa-clipboard-check' style='font-size:25px'></i>
                        Opret  medarbejder
                    </a>
                </li>

                <li class="nav-item">
                    <a type="button" onclick="sort_update_page(2)" class="nav-link text-dark font-italic bg-light">
                        <i class='fas fa-door-open' style='font-size:25px'></i>
                        Slet medarbejder
                    </a>
                </li>
            </ul>
            <p class="text-gray-brew font-weight-bold text-uppercase-brew px-3 small  mb-0 paddingChecker " style="font-size: 18px">Gæster</p>
            <ul class="nav flex-column bg-white mb-0 supplementNav">
                <li class="nav-item">
                    <a type="button" onclick="sort_update_page(3)" class="nav-link text-dark font-italic bg-light">
                        <i class='fas fa-clipboard-list' style='font-size:25px'></i>
                        Ændre gæsteoplysninger
                    </a>
                </li>
                <li class="nav-item">
                    <a type="button" onclick="sort_update_page(4)" class="nav-link text-dark font-italic bg-light">
                        <i class='fas fa-door-open' style='font-size:25px'></i>
                        Slet gæst
                    </a>
                </li>
                <li class="nav-item">
                    <a type="button" onclick="departed_all()" class="nav-link text-dark font-italic bg-light">
                        <i class='fas fa-door-open' style='font-size:25px'></i>
                        Opret gæst
                    </a>
                </li>

            </ul>
        </div>
    </div>



<!-- Dette er formularen til at slette en medarbejder  -->
    <div class="modal fade" id="delete_employee_div"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="height: 110%">
        <form id="form-data_delete_employee" method="post" action="/updateInfo/users/delete"  style="width: 39%;    margin-left: 26%;  ">
            @csrf
            @method('DELETE')
            <div class="modal-dialog" role="document" style="height: 89%">
                <div class="modal-content" style="height: 92%; width: 143%">
                    <div class="modal-header" style="background-color: #e3e3df">
                        <i class='fas fa-address-card' style='font-size:36px'></i>
                        <h3 class="modal-title" id="exampleModalLabel " style="text-align: center; margin-left: 28%; font-weight: 800">Medarbejderprofil</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h4 style="font-weight: bold; padding-bottom: 2%; border-bottom: 1px solid black"> Tjek venligst at du har valgt den korrekte medarbejder inden du afslutter. Når du er sikker, så tryk på knappen
                            "Afslut og slet"
                        </h4>

                        <u style="font-size: larger; font-weight: 600">Navn på arbejder</u>
                        <input id="name_employee_field_delete" name="employeeName"   class="input-group-text"   type="text"  style="width: 100%; height: 51px; border: 1px #1b1e21;margin-top: 1.5% " readonly >

                        <u style="font-size: larger; font-weight: 600">E-mail</u>
                        <input id="email_employee_field_delete" name="employeeEmail"   class="input-group-text"   type="text"  style="width: 100%; height: 51px; border: 1px #1b1e21; margin-top: 1.5% " readonly >


                        <u style="font-size: larger; font-weight: 600">Password</u>
                        <input id="password_employee_field_delete" name="employeePassword"   class="input-group-text"   type="password"  style="width: 100%; height: 51px; border: 1px #1b1e21; margin-top: 1.5% " readonly >
                        <input type="checkbox" onclick="showPassword()">Show Password
                        <input id="id_of_employee_delete" name="employeeId"   class="input-group-text"   type="text"  style="display: none" readonly >
                        <input  class="input-group-text"   type="text" value="1" name="type"  style="display: none" readonly >
                    </div>
                    <div class="modal-footer" style="height: 97px">
                        <button type="submit"  class="btn btn-info btn-submit" style="width: 61%; height: 79%; margin-right: 20%; padding: 1% ">Afslut og slet</button>
                    </div>
                </div>
            </div>
        </form>
    </div>



    <!--Slet en gæst-->
    <div class="modal fade" id="delete_guest_div"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="height: 110%">
        <form id="form-data_delete_guest" method="post" action="/updateInfo/users/delete/guest"  style="width: 39%;    margin-left: 26%;  margin-top: 5%;">
            @csrf
            @method('DELETE')
            <div class="modal-dialog" role="document" style="height: 89%">
                <div class="modal-content" style="height: 92%; width: 143%">
                    <div class="modal-header" style="background-color: #e3e3df">
                        <i class='fas fa-address-card' style='font-size:36px'></i>
                        <h3 class="modal-title" id="exampleModalLabel " style="text-align: center; margin-left: 28%; font-weight: 800">Profil på valgt gæst</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h4 style="font-weight: bold; padding-bottom: 2%; border-bottom: 1px solid black"> Tjek venligst at du har valgt den korrekte gæst inden du afslutter. Når du er sikker, så tryk på knappen
                            "Afslut og slet"
                        </h4>
                        <p>
                            <u style="font-size: larger; font-weight: 600">Navn på gæst</u>
                            <input id="guest_name_field_delete" name="guestName"   class="input-group-text"   type="text"  style="width: 100%; height: 51px; border: 1px #1b1e21;margin-top: 1.5% " readonly>
                        <p>

                        <p>
                            <u style="font-size: larger; font-weight: 600">Gæstens arbejdsplads/uddannelsessted</u>
                            <input id="guest_company_field_delete" name="guestCompany"   class="input-group-text"   type="text"  style="width: 100%; height: 51px; border: 1px #1b1e21; margin-top: 1.5% " readonly>

                        <p>
                        <p id="regsiteredTable" style="display: none"> <input  type="text" id="txtValue2" /></p>
                        <input id="id_of_guest_to_change_delete" name="guestId"   class="input-group-text"   type="text"  style="display: none" readonly>
                        <input  class="input-group-text"   type="text" value="2" name="type"  style="display: none" readonly>

                    </div>
                    <div class="modal-footer" style="height: 97px">
                        <button type="submit" id="unexpectedGuestsBtn" class="btn btn-info btn-submit" style="width: 61%; height: 79%; margin-right: 20%; padding: 1% ">Afslut og slet</button>
                    </div>
                </div>
            </div>
        </form>
    </div>




@endsection
