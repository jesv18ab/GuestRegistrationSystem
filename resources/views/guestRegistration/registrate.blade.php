
<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head class="headline">

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
    <?php
    $cardValue = 0;
    ?>

    <div style="margin-top: 20%;"   >
    <input id="guestInputCheckIn"  class="input-group-text" placeholder="Indtast dit navn her...."  onkeyup="findGuest()"  type="text"   style="display: none;width: 1000px; height: 80px">
    <input id="guestInputCheckOut"  class="input-group-text" placeholder="Indtast dit navn her...."  onkeyup="findGuest()"  type="text"   style="display: none">
    </div>

    <div id="checkButtons" class="checkInAndOut">
        <div class="btnGuests">  <a  type="submit"   onclick="checkIn()"><p > <b class="p">Check in</b> </p> </a></div>
   <div class="btnGuests"> <a  type="submit"   onclick="checkOut()">  <b class="p">Check Out</b> </a></div>
    </div>
        <form id="checkInForm" method="POST" action="guests/edit" >
            @csrf
            @method("PUT")
            <div class="control" id="guestsCheckIn" style="display: none" >
                <div class="field">
                        <div>
                            <table id="searchIn" style="display: none"  >
                                <tbody >
                                @foreach($guestsToCheckIn as $guest)
                                    <tr id="guest">
                                        <td>{{ $guest->name }}</td>

                                              <td>  <p>
                                                    <select class="dropdown" id="guestCards" style="margin-left: 30%; margin-right: 70%" required="required"  >
                                                        <option class="dropdown-item" value=""> Find ID-nummeret herunder..... </option>
                                                        (@foreach($cardsAvailable as $guestCard)
                                                            <option class="dropdown-item" value="{{ $guestCard->id }}"> {{ $guestCard->id }}</option>
                                                        @endforeach
                                                    </select>
                                            </p>
                                               <td style="display: none"> <p><input type="text" id="txtValue" /></p></td>
                                            <td>  <button class="btn btn-primary" type="submit" value="Show Index" onclick="showSelected( {{ $guest->id }});"  style="width: 150%; height: 150%; margin-left: 100%" > check In</button></td>

                                    </tr>
                              @endforeach
                                </tbody>

                            </table>

                        </div>

                    </div>

            </div>

        </form>

        <form method="Post">
            @csrf
            @method("PUT")
        <div  id="guestsCheckOut" style="display: none">
        <table id="searchOut" style="display: none"  >
            <tbody >
            @foreach($guestsToCheckOut as $guest)
                <tr>
                    <td>{{ $guest->name }}</td>
                    <td ><button type="submit"  class="btn btn-primary btn-block" formaction="guests/edit">Check out</button> </td>
                </tr>

            </tbody>
            @endforeach
        </table>
        </div>
        </form>

</div>

</body>

<script>

    function showSelected( $i)
    {
        var c =$i
        var selObj = document.getElementById('guestCards');
        var txtIndexObj = document.getElementById('txtIndex');
        var txtValueObj = document.getElementById('txtValue');
        var txtTextObj = document.getElementById('txtText');

        var selIndex = selObj.selectedIndex;
        var test = txtValueObj.value = selObj.options[selIndex].value;

        document.getElementById('checkInForm').action = "guests/" + c + "/"+ test  + "/edit";
    }


    function chosenCard() {
        document.getElementById("showCard").style.display= "block";
        document.getElementById("hideCard").style.display="none";
    }


    function findGuest() {
        // Declare variables
        var input, table, filter, tr, td, i, txtValue ;
        if (document.getElementById("guestInputCheckIn").style.display == "block"){
            table = document.getElementById("searchIn");
            input = document.getElementById("guestInputCheckIn");
        }else if (document.getElementById("guestInputCheckOut").style.display == "block"){
            table = document.getElementById("searchOut");
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
        /*
    <select id="cards">

            <option class=" btn btn-primary" selected="selected">{{ $guestCard->id }}</option>
            <input type="text" style="display: none">

            </select>
        */

        checkBox()
    }
    function checkBox() {
        if (document.getElementById("guestInputCheckIn").value == '' ){
            document.getElementById("searchIn").style.display = "none";
        }if (document.getElementById("guestInputCheckOut").value == ''){
            document.getElementById("searchOut").style.display = "none";

        }
    }
    function checkIn() {
        document.getElementById("guestInputCheckIn").style.display ="block";
        document.getElementById("guestsCheckIn").style.display ="block";
        document.getElementById("checkButtons").style.display ="none";
        document.getElementById("guestInputCheckOut").style.display ="none";

    }
    function checkOut() {
        document.getElementById("guestInputCheckOut").style.display ="block";
        document.getElementById("guestsCheckOut").style.display ="block";
        document.getElementById("guestInputCheckIn").style.display ="none";
        document.getElementById("checkButtons").style.display ="none";
    }
















    /*
     <form method="GET">
        <select name="Cards" id="Cards">
            <option value="">Select here.....</option>

    <option type="submit"  value="{{ $guestCard->id }}"> {{ $guestCard->id }}</option>

    </select>
    <input type="submit" name="submit" value="Choose card" />
</form>


     */







</script>


</html>







