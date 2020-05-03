@extends('layouts.app')


@section('content')
<div class="employeeGuests">
    <h2 style="color: black">Dine aftaler i dag</h2>
</div>

    <div class="tablesDiv4 shadow" id="" style=" height: 30rem; margin-right: 19%; margin-top: 1%">
        <div class="tablesDiv3 " >
            <table id="change_employee"  class="guestTable2 supplementNav2"  align="center" style=" width: 100%; display: table; " value="true" >
                <thead>
                <tr>
                    <th class="supplementNav3" ><h4>Navn</h4></th>
                    <th class="supplementNav3"><h4>Forventet ankomst</h4></th>
                    <th class="supplementNav3"><h4>Company</h4></th>
                </tr>
                </thead>
                <tbody id="">
                @foreach($list_of_guests as $guest)
                    <tr >
                        <td   style="height: 75px; " >{{$guest->name}}</td>
                        <td > {{$guest->time_created}}</td>
                        <td> {{$guest->company}}
                        </td>                        </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>



    @endsection
