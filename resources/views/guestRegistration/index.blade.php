@extends('layouts.app')


@section('content')
    <div class="headline"  > <h1> <b>Gæste oversigten</b> </h1>
    </div>'

    <div class="tablesDiv" >
        <form method="get" >
            @csrf

            <table id="expected" class="guestTable"  align="center" style="display: table" value="true" >
                <thead>
                <tr>
                    <th><h5>Name</h5></th>
                    <th><h5>Ankomst klokken</h5></th>
                    <th><h5>Check in</h5></th>
                </tr>
                </thead>
                <tbody>
                @foreach($guests as $guest)
                    <tr>
                        <td  >{{ $guest->name }}</td>
                        <td > {{$guest->expected_at}} {{ $guest->time }}</td>
                        <td ><button class="btn btn-primary">Check in</button> </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <table id="arrived" class="guestTable"  align="center"  style="display: none"  value="false"  >
                <thead>
                <th > <h5>Navn</h5> </th>
            <th> <h5>Tidspunkt for ankomst</h5></th>
                <th><h5> Check out</h5></th>
                </thead>

                <tbody>
                @foreach($guestsCheckedIn as $guest)
                    <tr >
                        <td >{{ $guest->name }}</td>
                        <td > {{$guest->updated_at}} {{ $guest->time }}</td>
                        <td ><button class="btn btn-primary">Check out</button> </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <table id="departed" class="guestTable"  align="center"  style="display: none" value="false" >
                <thead>
                <th > <h5>Name</h5> </th>
                <th> <h5>Sidste besøg</h5></th>
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
<div class="filterDiv">
    <input class="form-control"  type="text" id="guestInputExpected" onkeyup="findGuestExpected()" style="display: block" placeholder="Find gæst her.." title="Type in a name" >
    <input class="form-check-input" type="text" id="guestInputArrived" onkeyup="findGuestArrived()" style="display: none" placeholder="Find gæst her.." title="Type in a name" >
    <input class="form-check-input" type="text" id="guestInputDeparted" onkeyup="findGuestDeparted()" style="display: none" placeholder="Find gæst her.." title="Type in a name" >

</div>

    <div>
        <div class="alignButtons">
            <div class="buttonDiv"> <button type="button" class="btn btn-primary btn-block" id="showExpected" onclick="expected()" >Vis forventede ankomster</button></div>
            <div class="buttonDiv"> <button type="button" class="btn btn-primary btn-block" id="showArrived" onclick="arrived()">Vis gæster lige nu</button></div>
            <div class="buttonDiv"><button type="button" class="btn btn-primary btn-block" id="showDeparted" onclick="departed()">Vis tidligere gæster</button></div>
        </div>



    </div>


@endsection

<script type="text/javascript">


  function arrived() {
      var showArrivedTable = document.getElementById("arrived");
      var showExpectedTable = document.getElementById("expected");
      var showDepartedTable = document.getElementById("departed");
      var filterBoxExpected = document.getElementById("guestInputExpected");
      var filterBoxArrived     = document.getElementById("guestInputArrived");
      var filterBoxDeparted = document.getElementById("guestInputDeparted");
      showExpectedTable.style.display = "none";
      filterBoxExpected.style.display = "none";

      showDepartedTable.style.display = "none";
      filterBoxDeparted.style.display = "none";

      showArrivedTable.style.display = "table";
      filterBoxArrived.style.display = "block";
  }
  function departed() {
      var showArrivedTable = document.getElementById("arrived");
      var showExpectedTable = document.getElementById("expected");
      var showDepartedTable = document.getElementById("departed");
      var filterBoxExpected = document.getElementById("guestInputExpected");
      var filterBoxArrived     = document.getElementById("guestInputArrived");
      var filterBoxDeparted = document.getElementById("guestInputDeparted");

      showArrivedTable.style.display = "none";
      filterBoxArrived.style.display = "none";

      showExpectedTable.style.display = "none";
      filterBoxExpected.style.display = "none";

      showDepartedTable.style.display = "table";
      filterBoxDeparted.style.display = "block";
      }
  function expected() {
      var showArrivedTable = document.getElementById("arrived");
      var showExpectedTable = document.getElementById("expected");
      var showDepartedTable = document.getElementById("departed");
      var filterBoxExpected = document.getElementById("guestInputExpected");
      var filterBoxArrived     = document.getElementById("guestInputArrived");
      var filterBoxDeparted = document.getElementById("guestInputDeparted");

      showArrivedTable.style.display = "none";
      filterBoxArrived.style.display = "none";

      showDepartedTable.style.display = "none";
      filterBoxDeparted.style.display = "none";

      showExpectedTable.style.display = "table";
      filterBoxExpected.style.display = "block";
  }
          function findGuestExpected( ) {
              var showExpected = document.getElementById("expected");
              // Declare variables
              var input, filter, tr, td, i, txtValue;
              input = document.getElementById("guestInputExpected");
              filter = input.value.toUpperCase();
              tr = showExpected.getElementsByTagName("tr");
              // Loop through all table rows, and hide those who don't match the search query
              for (i = 0; i < tr.length; i++) {
                  td = tr[i].getElementsByTagName("td")[0];
                  if (td) {
                      txtValue = td.textContent || td.innerText;
                      if (txtValue.toUpperCase().indexOf(filter) > -1) {
                          tr[i].style.display = "";
                      } else {
                          tr[i].style.display = "none";
                      }
                  }
              }
          }

          function findGuestArrived( ) {
              var showArrived = document.getElementById("arrived");
              // Declare variables
              var input, filter, tr, td, i, txtValue;
              input = document.getElementById("guestInputArrived");
              filter = input.value.toUpperCase();
              tr = showArrived.getElementsByTagName("tr");
              // Loop through all table rows, and hide those who don't match the search query
              for (i = 0; i < tr.length; i++) {
                  td = tr[i].getElementsByTagName("td")[0];
                  if (td) {
                      txtValue = td.textContent || td.innerText;
                      if (txtValue.toUpperCase().indexOf(filter) > -1) {
                          tr[i].style.display = "";
                      } else {
                          tr[i].style.display = "none";
                      }
                  }
              }
          }

          function findGuestDeparted( ) {
              var showDeparted = document.getElementById("guestInputDeparted");
              // Declare variables
              var input, filter, tr, td, i, txtValue;
              input = document.getElementById("myInput");
              filter = input.value.toUpperCase();
              tr = showDeparted.getElementsByTagName("tr");
              // Loop through all table rows, and hide those who don't match the search query
              for (i = 0; i < tr.length; i++) {
                  td = tr[i].getElementsByTagName("td")[0];
                  if (td) {
                      txtValue = td.textContent || td.innerText;
                      if (txtValue.toUpperCase().indexOf(filter) > -1) {
                          tr[i].style.display = "";
                      } else {
                          tr[i].style.display = "none";
                      }
                  }
              }
          }




</script>

