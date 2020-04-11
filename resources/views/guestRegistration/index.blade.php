@extends('layouts.app')


@section('content')

<div class="container2" style="margin-top: 6%">

    <div class="tablesDiv2 shadow"  >
        <form  method="get" >
            @csrf
            <table id="expected" class="guestTable supplementNav2  "  align="center" style="display: table; width: 100%" value="true" >
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
                        <td > {{$guest->expected_at}} {{ $guest->time }}</td>
                        <td ><button class="btn btn-light shadow" style="width: 200px; height: 50px">Check in</button> </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <table id="arrived" class="guestTable supplementNav2"  align="center"  style="display: none"  value="false"  >
                <thead>
                <th class="supplementNav3" > <h4>Navn</h4> </th>
                <th class="supplementNav3"> <h4>Tidspunkt for ankomst</h4></th>
                <th class="supplementNav3"><h4> Check out</h4></th>
                </thead>
                <tbody>
                @foreach($guestsCheckedIn as $guest)
                    <tr >
                        <td >{{ $guest->name }}</td>
                        <td  > {{$guest->updated_at}} {{ $guest->time }}</td>
                        <td ><button class="btn btn-primary">Check out</button> </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <table id="departed" class="guestTable supplementNav2"  align="center"  style="display: none" value="false" >
                <thead>
                <th class="supplementNav3" > <h4>Name</h4> </th>
                <th class="supplementNav3"> <h4>Sidste besøg</h4></th>
                </thead>
                <tbody>
                @foreach($guestsCheckedOut as $guest)
                    <tr >
                        <td >{{ $guest->name }}</td>
                        <td > {{$guest->created_at}} {{ $guest->time }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </form>
    </div>
</div>

    <div class="vertical-nav-brew bg-white" id="sidebar" style="height: 570px; margin-left: 4%; ">
        <p class="text-black-brew font-weight-bold text-uppercase-brew px-3 col-sm pb-4 mb-0" style=" text-align: center; padding: 0;   color: black">Gæsteoversigten</p>
        <div class="filterDiv">
            <div id="guest-Input-Div" class="input-group" style="width: 450px">
            <span class="input-group-addon">  <i class='fas fa-search' style='font-size:40px'>
            </i></span>
                <input class="form-control"  type="text" id="input-box" onkeyup="findGuests()"  placeholder="Find gæst her.." title="Type in a name" style="margin-bottom: 3%; height: 50px" >
            </div>
        </div>


        <p class="text-gray-brew font-weight-bold text-uppercase-brew px-3 small py-4 mb-0" style="padding-top: 0.6rem">Gæster i dag</p>
        <ul class="nav flex-column bg-white mb-0 supplementNav">
            <li class="nav-item">
                <a type="button" onclick="expected()" class="nav-link text-dark font-italic bg-light">
                    <i class='fas fa-clipboard-list' style='font-size:25px'></i>
                    Vis forventede gæster
                </a>

            </li>
            <li class="nav-item">
                <a type="button" onclick="arrived()" class="nav-link text-dark font-italic bg-light">
                    <i class='fas fa-clipboard-check' style='font-size:25px'></i>
                    Vis gæster som er checket checket ind i dag
                </a>
            </li>

            <li class="nav-item">
                <a type="button" onclick="departed()" class="nav-link text-dark font-italic bg-light">
                    <i class='fas fa-door-open' style='font-size:25px'></i>
                    Vis tidligere besøgende i dag
                </a>
            </li>
        </ul>
        <p class="text-gray-brew font-weight-bold text-uppercase-brew px-3 small py-4 mb-0">Det generelle overblik</p>

            <ul class="nav flex-column bg-white mb-0 supplementNav">
                <li class="nav-item">
                    <a type="button" onclick="expected()" class="nav-link text-dark font-italic bg-light">
                        <i class='fas fa-clipboard-list' style='font-size:25px'></i>
                        Vis alle forventede gæster
                    </a>

                </li>

                <li class="nav-item">
                    <a type="button" onclick="departed()" class="nav-link text-dark font-italic bg-light">
                        <i class='fas fa-door-open' style='font-size:25px'></i>
                        Vis alle tidligere gæster
                    </a>
                </li>
        </ul>
    </div>

    <div>

    </div>



@endsection
