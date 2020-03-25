
<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head class="headline">
    <style>
        .searchDiv{
            margin-left: 25%;
            margin-top: 16%;
            width: 50%;
            height: 50%;
            border: 1px solid #1b1e21;
        }

        .headerDiv{
            text-align: center;
        }
        .btnGuests{
            display: inline-block;
            text-decoration: none;
            color: #FFF;
            width: 200px;
            height: 200px;
            line-height: 150px;
            border-radius: 50%;
            text-align: center;
            font-size: xx-large;
            fon-
            vertical-align: middle;
            overflow: hidden;
            background-image: -webkit-linear-gradient(45deg, #709dff 0%, #91fdb7 100%);
            background-image: linear-gradient(45deg, #709dff 0%, #91fdb7 100%);
            transition: .4s;
            margin-left: 25%;
        }
        .btnGuests:hover{
             -webkit-transform: rotate(10deg);
             -ms-transform: rotate(10deg);
             transform: rotate(10deg);
         }

        .p{
            color: #1b1e21;
        }
        .checkInAndOut{
            alignment: center;
            margin-top: 20%;
            height: 100%;
            width: 100%;
            float: left;

        }



    </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Scripts -->
    <script src="{{ asset('assets/js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('assets/scss/mainStyle.css') }}" rel="stylesheet">

</head>

<body>

<div class="container">
    <input id="guestInputCheckIn"  class="guestTable"  onkeyup="findGuest()"  type="text"   style="display: none">
    <input id="guestInputCheckOut"  class="guestTable"  onkeyup="findGuest()"  type="text"   style="display: none">

    <div id="checkButtons" class="checkInAndOut">
        <div class="btnGuests">  <a  type="submit"   onclick="checkIn()"><p > <b class="p">Check in</b> </p> </a></div>
   <div class="btnGuests"> <a  type="submit"   onclick="checkIn()">  <b class="p">Check Out</b> </a></div>
    </div>


    <form method="POST" style="border:1px solid #ccc">

        @csrf
        @method("PUT")

        <table id="guestsCheckIn" style="display: none" >
            <tbody >
            @foreach($guestsToCheckIn as $guest)
            <tr>
                <td>{{ $guest->name }}</td>
                <td ><button type="submit"  class="btn btn-primary" formaction="guests/{{ $guest->id }}/edit">Check in</button> </td>
            </tr>
            @endforeach

            </tbody>
        </table>

        <table id="guestsCheckOut" style="display: none" >
            <tbody >
            @foreach($guestsToCheckOut as $guest)
                <tr>
                    <td>{{ $guest->name }}</td>
                    <td ><button type="submit"  class="btn btn-primary" formaction="guests/{{ $guest->id }}/edit">Check Out</button> </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </form>
</div>

<script>

    function findGuest() {
            // Declare variables
            var input, table, filter, tr, td, i, txtValue ;
            if (document.getElementById("guestInputCheckIn").style.display == "block"){
                table = document.getElementById("guestsCheckIn");
                input = document.getElementById("guestInputCheckIn");
            }else if (document.getElementById("guestInputCheckOut").style.display == "block"){
                table = document.getElementById("guestsCheckOut");
                input = document.getElementById("guestInputCheckOut");
            }
            filter = input.value.toUpperCase();
            tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1 ) {
                    table.style.display="";
                    tr[i].style.display = "";

                } else {
                    tr[i].style.display = "none";
                }
            }
        }

        checkBox()
        }
        function checkBox() {
          if (document.getElementById("guestInputCheckIn").value == '' ){
              document.getElementById("guestsCheckIn").style.display = "none";
          }if (document.getElementById("guestInputCheckOut").value == ''){
                document.getElementById("guestsCheckOut").style.display = "none";

            }
        }
    function checkIn() {
    document.getElementById("guestInputCheckIn").style.display ="block";
    document.getElementById("checkButtons").style.display ="none";
    document.getElementById("guestInputCheckOut").style.display ="none";

    }
    function checkOut() {
        document.getElementById("guestInputCheckOut").style.display ="block";
        document.getElementById("guestInputCheckIn").style.display ="none";
        document.getElementById("checkButtons").style.display ="none";
    }


</script>

</body>

</html>







