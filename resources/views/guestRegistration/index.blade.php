@extends('layouts.app')


@section('content')

<div class="container2" style="margin-top: 6%">

    <div id="tableDiv2" class="tablesDiv2 shadow"  >
        <table id="expected_today" class="guestTable supplementNav2  "  align="center" style="display: table; width: 100%" value="true" >
            <thead >
            <tr>
                <th class="supplementNav3"><h4>Name</h4></th>
                <th class="supplementNav3"><h4>Ankomst klokken</h4></th>
                <th class="supplementNav3"><h4>Virksomhed</h4></th>
            </tr>
            </thead>
            <tbody>
            @foreach($guests_Today_Check_In as $guest)
                <tr>
                    <td  style="height: 10px" >{{ $guest->name }}</td>
                    <td> {{$guest->expected_at}} {{ $guest->time_expected }}</td>
                    <td>Test virksomhed</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <table id="departed_today" class="guestTable supplementNav2 "  align="center" style="display: none; width: 100%" value="true" >
            <thead  >
            <tr>
                <th class="supplementNav3"><h4>Name</h4></th>
                <th class="supplementNav3"><h4>Forlod Amgros klokken:</h4></th>
                <th class="supplementNav3"><h4>Virksomhed</h4></th>
            </tr>
            </thead>
            <tbody>
            @foreach($guests_Today_Checked_Out as $guest)
                <tr>
                    <td  style="height: 10px" >{{ $guest->name }}</td>
                    <td> {{$guest->created_at}} {{ $guest->time_departed}}</td>
                    <td>Test virksomhed</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <table id="arrived_today" class="guestTable supplementNav2"  align="center"  style="display: none"  value="false"  >
            <thead>
            <th class="supplementNav3" > <h4>Navn</h4> </th>
            <th class="supplementNav3"> <h4>Tidspunkt for ankomst</h4></th>
            <th class="supplementNav3"> <h4>Kort Id</h4></th>
            <th class="supplementNav3"><h4> Check out</h4></th>
            </thead>
            <tbody>
            @foreach($guests_Today_arrived as $guest)
                <tr >
                    <td >{{ $guest->name }}</td>
                    <td  > {{$guest->updated_at}} {{ $guest->time_arrived }}</td>
                    <td>{{$guest->id}}</td>
                    <td ><button class="btn btn-primary">Check out</button> </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <table id="departed_all" class="guestTable supplementNav2"  align="center"  style="display: none; width: 100%" value="false" >
            <thead>
            <th class="supplementNav3" > <h4>Name</h4> </th>
            <th class="supplementNav3"> <h4>Sidste besøg</h4></th>
            <th class="supplementNav3"> <h4>Virksomheds navn</h4></th>

            </thead>
            <tbody>
            @foreach($guestsCheckedOut as $guest)
                <tr >
                    <td >{{ $guest->name }}</td>
                    <td > {{$guest->created_at}} {{ $guest->time_departed }}</td>
                    <td > Virksomhedens navn</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <form id="expected_all"  method="get" style="display: none;" >
            @csrf
            <table id="expected_all_table"  class="guestTable supplementNav2 "  align="center" style=" width: 100%" value="true" >
                <thead  >
                <tr>
                    <th class="supplementNav3"><h4>Name</h4></th>
                    <th class="supplementNav3"><h4>Ankomst klokken</h4></th>
                    <th class="supplementNav3"><h4>Check in</h4></th>
                </tr>
                </thead>
                <tbody>
                @foreach($guests as $guest)
                    <tr>
                        <td  style="height: 75px" >{{ $guest->name }}</td>
                        <td > {{$guest->expected_at}} {{ $guest->time_expected }}</td>
                        <td ><button class="btn btn-light shadow" style="width: 200px; height: 50px">Check in</button> </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </form>
    </div>
    <div class="tablesDiv4 shadow" id="check_in" style=" display: none; height: 30rem">
    <div class="tablesDiv3 shadow" id="check_in">
            <table id="check_in_table"  class="guestTable2 supplementNav2 "  align="center" style=" width: 100%" value="true" >
                <thead>
                <tr>
                    <th class="supplementNav3" ><h4>Personer valgt/Ikke valgt</h4></th>
                    <th class="supplementNav3"><h4>Name</h4></th>
                    <th class="supplementNav3"><h4>Ankomst klokken</h4></th>
                    <th class="supplementNav3" colspan="2"><h4>Vælg Id kort til gæst og tryk "Vælg"</h4></th>
                </tr>
                </thead>
                <tbody id="check_in_table_body">
                @foreach($guests as $guest)
                    <tr id="tr{{ $guest->id }}" name="false" >
                        <td id="td{{ $guest->id }}" style="display: none" >{{$guest->id}}</td>
                        <td ><!-- Default unchecked -->
                            <div class="custom-control custom-checkbox  ">
                                <input id="checkbox{{$guest->id}}" value="false"  type="checkbox" class="custom-control-input">
                                <label class="custom-control-label bg-white" for="tableDefaultCheck3"></label>
                            </div>
                        </td>
                        <td   style="height: 75px; " >{{ $guest->name }}</td>
                        <td > {{$guest->expected_at}} {{ $guest->time_expected }}</td>
                        <td id="td_select"{{ $guest->id }} >

                                <select id="{{ $guest->id }}" class="custom-select" id="cardIsPicked2" style="margin-left: 9%; margin-top: 5%; width: 92px; height: 67%" >
                                    <option value="">Id-kort </option>
                                    @foreach($cardsAvailable as $guestCard)
                                        <option  value="{{ $guestCard->id }}">{{ $guestCard->id }}</option>
                                    @endforeach
                                </select>
                        </td>
                        <td ><button id="check_btn{{ $guest->id }}" class="btn btn-light shadow"  type="submit" style="width: 200px; height: 50px; padding-left: 3%" onclick="select_row({{ $guest->id }})">Vælg</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>


    </div>


<div style="text-align:center">
    <form id="execute_move" method="Post " data-route="/guests/edit">
        @csrf
        <button id="in_advance " class="btn btn-light shadow bg-cream " onclick="move_person()" style="width: 71%; height: 50px; margin-top: 1%; background-color:#d2d2d0; border-color: #d2d2d0">Afslut check in</button>
    </form>
</div>
    </div>
    <div class="tablesDiv4 shadow" id="check_out_in_advance" style=" display: none; height: 30rem">
        <div class="tablesDiv3 shadow" id="check_out_in_advance">
            <table id="check_out__in_advance_table"  class="guestTable2 supplementNav2 "  align="center" style=" width: 100%" value="true" >
                <thead>
                <tr>
                    <th class="supplementNav3" ><h4>Personer valgt/Ikke valgt</h4></th>
                    <th class="supplementNav3"><h4>Name</h4></th>
                    <th class="supplementNav3"><h4>Ankomst klokken</h4></th>
                    <th class="supplementNav3" colspan="2"><h4>Vælg Id kort til gæst og tryk "Vælg"</h4></th>
                </tr>
                </thead>
                <tbody id="check_in_table_body">
                @foreach($guests_Today_arrived as $guest)
                    <tr id="tr{{ $guest->id }}" name="false" >
                        <td id="td{{ $guest->id }}" style="display: none" >{{$guest->id}}</td>
                        <td ><!-- Default unchecked -->
                            <div class="custom-control custom-checkbox  ">
                                <input id="checkbox{{$guest->id}}" value="false"  type="checkbox" class="custom-control-input">
                                <label class="custom-control-label bg-white" for="tableDefaultCheck3"></label>
                            </div>
                        </td>
                        <td   style="height: 75px; " >{{ $guest->name }}</td>
                        <td > {{$guest->updated_at}} {{ $guest->time_arrived }}</td>
                        <td id="td_select"{{ $guest->id }} >

                            <select id="{{ $guest->id }}" class="custom-select" id="cardIsPicked2" style="margin-left: 9%; margin-top: 5%; width: 92px; height: 67%" >
                                <option value="">Id-kort </option>
                                @foreach($cardsAvailable as $guestCard)
                                    <option  value="{{ $guestCard->id }}">{{ $guestCard->id }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td ><button id="check_btn{{ $guest->id }}" class="btn btn-light shadow"  type="submit" style="width: 200px; height: 50px; padding-left: 3%" onclick="select_row({{ $guest->id }})">Vælg</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>


        </div>


        <div style="text-align:center">
            <form id="execute_move" method="Post " data-route="/guests/edit">
                @csrf
                <button id="in_advance " class="btn btn-light shadow bg-cream " onclick="move_person()" style="width: 71%; height: 50px; margin-top: 1%; background-color:#d2d2d0; border-color: #d2d2d0">Afslut check in</button>
            </form>
        </div>
    </div>


    <div class="vertical-nav-brew bg-white" id="sidebar" style="height: 570px; margin-left: 4%; ">
        <p class="text-black-brew font-weight-bold text-uppercase-brew px-3 col-sm mb-0 paddingChecker" style=" text-align: center;   color: black; font-size: 20px;">Gæsteoversigten</p>
        <div class="filterDiv">
            <div id="guest-Input-Div" class="input-group" style="width: 450px">
            <span class="input-group-addon">  <i class='fas fa-search' style='font-size:40px'>
            </i></span>
                <input class="form-control"  type="text" id="input-box" onkeyup="findGuests()"  placeholder="Find gæst her.." title="Type in a name" style="margin-bottom: 3%; height: 50px" >
            </div>
        </div>

        <p class="text-gray-brew font-weight-bold text-uppercase-brew px-3 small mb-0 paddingChecker" style=" font-size: 18px">Gæster i dag</p>
        <ul class="nav flex-column bg-white mb-0 supplementNav">
            <li class="nav-item">
                <a type="button" onclick="expected_today()" class="nav-link text-dark font-italic bg-light">
                    <i class='fas fa-clipboard-list' style='font-size:25px'></i>
                    Vis forventede gæster i dag
                </a>

            </li>
            <li class="nav-item">
                <a type="button" onclick="arrived_today()" class="nav-link text-dark font-italic bg-light">
                    <i class='fas fa-clipboard-check' style='font-size:25px'></i>
                    Vis gæster som er checket  ind i dag
                </a>
            </li>

            <li class="nav-item">
                <a type="button" onclick="departed_today()" class="nav-link text-dark font-italic bg-light">
                    <i class='fas fa-door-open' style='font-size:25px'></i>
                    Vis tidligere besøgende i dag
                </a>
            </li>
        </ul>
        <p class="text-gray-brew font-weight-bold text-uppercase-brew px-3 small  mb-0 paddingChecker " style="font-size: 18px">Det generelle overblik</p>
        <ul class="nav flex-column bg-white mb-0 supplementNav">
            <li class="nav-item">
                <a type="button" onclick="expected_all()" class="nav-link text-dark font-italic bg-light">
                    <i class='fas fa-clipboard-list' style='font-size:25px'></i>
                    Vis alle forventede gæster
                </a>
            </li>
            <li class="nav-item">
                <a type="button" onclick="departed_all()" class="nav-link text-dark font-italic bg-light">
                    <i class='fas fa-door-open' style='font-size:25px'></i>
                    Alle tidligere besøgende
                </a>
            </li>

            <p class="text-gray-brew font-weight-bold text-uppercase-brew px-3 small  mb-0 paddingChecker " style="font-size: 18px">Check gæster ind på forhånd</p>
            <li class="nav-item">
                <a type="button" onclick="in_advance_Check_in()" class="nav-link text-dark font-italic bg-light">
                    <i class='fas fa-door-open' style='font-size:25px'></i>
                    Check in
                </a>
            </li> <li class="nav-item">
                <a type="button" onclick="check_out_from_admin()" class="nav-link text-dark font-italic bg-light">
                    <i class='fas fa-door-open' style='font-size:25px'></i>
                    Check out
                </a>
            </li>
        </ul>





@endsection
