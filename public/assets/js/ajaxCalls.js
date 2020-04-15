
$(function () {
    $('#form-data').submit(function (e) {
        var guestId;
        var selObj2 = document.getElementById('cardIsPicked2');
        var txtValueObj2 = document.getElementById('txtValue2');
        var selIndex2 = selObj2.selectedIndex;
        var guestCardID2 = txtValueObj2.value = selObj2.options[selIndex2].value;
        var route = $('#form-data').data('route');
        var form_data = $(this);
        var name = document.getElementById("unexpectedGuest").value;
        $.ajax({
            type: 'post' ,
            url: "/ajaxRequest/" + name,
            data: form_data.serialize(),
            success: function(data) {
                alert("første trin er udført" + data + "" + guestCardID2);
                var route = $('#form-data-Put').data('route');
                var form_data_put = $(this);
                $.ajax({
                    type: 'put' ,
                    url: '/ajaxRequest/' + data +"/" + guestCardID2 +  '/edit',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: form_data_put.serialize(),
                    success: function(data) {
                        alert("Du er checket ind");
                        callBackFunction()
                    }
                });
            },
        });
        e.preventDefault();

    })
});

function guest_Check_in(id){
    $('#executeCheckIn').submit(function (e) {
        var selObj = document.getElementById('cardIsPicked');
        var txtValueObj = document.getElementById('txtValue');
        var selIndex = selObj.selectedIndex;
        var guestCardID = txtValueObj.value = selObj.options[selIndex].value;
        var route = $('#executeCheckIn').data('route');
        var form_data = $(this);
        $.ajax({
            type: 'put' ,
            url: "/guests/" + id + "/" + guestCardID + "/edit",
            data: form_data.serialize(),
            success: function(data) {
                $.ajax({
                    type: 'GET' ,
                    url: '/ajaxGuestPage/guestsRegistration',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function(data) {
                        $("#searchIn").load(window.location + " #searchIn");
                        alert("Du er hermed registreret! Du ønskes en rigtig god dag ")
                    }
                });
            },
        });
        e.preventDefault();

    });
}
function guest_Check_out(guest_id, card_id){
    $('#executeCheckOut').submit(function (e) {
        var route = $('#executeCheckOut').data('route');
        var form_data = $(this);
        $.ajax({
            type: 'put' ,
            url: "/guests/" + guest_id + "/" + card_id + "/edit",
            data: form_data.serialize(),
            success: function(data) {
                $.ajax({
                    type: 'GET' ,
                    url: '/ajaxGuestPage/guestsRegistration',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function(data) {
                        $("#searchIn").load(window.location + " #searchO");
                        $("#searchOut").load(window.location + " #searchOut");
                        alert("Du er hermed checket ud! Håber du har haft et godt besøg!")
                    }
                });
            },
        });
        e.preventDefault();
    });
}

function guest_Check_in_admins(guest_id, card_id){
    $('#executeCheckOut').submit(function (e) {
        var route = $('#executeCheckOut').data('route');
        var form_data = $(this);
        $.ajax({
            type: 'put' ,
            url: "/guests/" + guest_id + "/" + card_id + "/edit",
            data: form_data.serialize(),
            success: function(data) {
                $.ajax({
                    type: 'GET' ,
                    url: '/ajaxGuestPage/guestsRegistration',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function(data) {
                        $("#searchIn").load(window.location + " #searchO");
                        $("#searchOut").load(window.location + " #searchOut");
                        alert("Du er hermed checket ud! Håber du har haft et godt besøg!")
                    }
                });
            },
        });
        e.preventDefault();

    });
}



function  openSearchField(){
        $('.search-button').parent().toggleClass('open');
    }

window.onscroll = function() {myFunction()};

var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;

function myFunction() {
    if (window.pageYOffset >= sticky) {
        navbar.classList.add("sticky")
    } else {
        navbar.classList.remove("sticky");
    }
}



function callBackFunction() {
    window.location = "guestsRegistration";
}

function quickCheckIn( id, card  )
{
    alert(id + "" + card);
    document.getElementById('executeCheckIn').action = "guests/"+id +"/" + card + "/edit";
}

function showSelected( id ) {
    var guestId;
    var selObj = document.getElementById('cardIsPicked');
    var selIndex = selObj.selectedIndex;
    var guestCardID = txtValueObj.value = selObj.options[selIndex].value;
    var route = $('#executeCheckIn').data('route');
    var form_data = $(this);
    $.ajax({
        type: 'get',
        method:'PUT',
        url: "/guests/" + id + "/" + guestCardID + "edit",
        data: form_data.serialize(),
        success: function (data) {
            alert("Du har checket følgende person med dette ID ind" + id + "" + guestCardID2 + data);
        },
    });
}

function chosenCard() {
    document.getElementById("showCard").style.display= "block";
    document.getElementById("hideCard").style.display="none";
}

function searchForGuest() {
    // Declare variables
    var input, table, filter, tr, td, i, txtValue ;
    if (document.getElementById("checkInOpen").style.display == ""){
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
    document.getElementById("checkInOpen").style.display ="";
    document.getElementById("guestsCheckIn").style.display ="block";
    document.getElementById("inputBoxes").style.display ="";
    document.getElementById("unexpected1").style.display ="";
    setTimeout(openSearchField, 100 );
    document.getElementById("checkButtons").style.display ="none";
    document.getElementById("guestInputCheckOut").style.display ="none";
}
function checkOut() {
    document.getElementById("guestInputCheckOut").style.display ="block";
    document.getElementById("guestsCheckOut").style.display ="block";
    document.getElementById("guestInputCheckIn").style.display ="none";
    document.getElementById("inputBoxes").style.display ="";
    document.getElementById("checkOutOpen").style.display ="";
    setTimeout(openSearchField, 500 );
    document.getElementById("checkInOpen").style.display ="none";
    document.getElementById("checkButtons").style.display ="none";
}

function checkInUnExpectedGuests() {
    document.getElementById('executeCheckIn').style.display = 'none';
    document.getElementById('inputBoxes').style.display = 'none';
    document.getElementById('divForUnregisteredGuests').style.display = '';
}

function goToGuestRegistration() {
    window.location = "registerGuest";
}
function guestOverview() {
    window.location = "guests";
}
function guestPage() {
    window.location = "guestsRegistration";
}



function reBooK(){
    document.getElementById("newGuests").style.display = "none";
    document.getElementById("formerGuests").style.display = "";
    document.getElementById("formerGuests_container").style.display = "";
    document.getElementById("formerGuestsTable").style.display = "";
}
function setName(guestName, guestId) {
    document.getElementById("nameInput").value = guestName;
    document.getElementById("guestId").value = guestId;
}
function executeBooking(){
    var name = document.getElementById("nameInput").value;
    var id = document.getElementById("guestId").value;
    document.getElementById('formNewBooking').action = "guests/"+ id +"/0000/edit";
}




function findGuest() {
    // Declare variables
    var input, table, filter, tr, td, i, txtValue ;
    table = document.getElementById("searcGuests");
    input = document.getElementById("searchForGuest");
    filter = input.value.toUpperCase();
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1 ) {
                tr[i].style.display = "";

            } else {
                tr[i].style.display = "none";
            }
        }
    }

}


function arrived_today() {
    var show_Expected_Table_Today = document.getElementById("expected_today");
    var show_all_table_expected = document.getElementById("expected_all");

    //arrived Tables
    var show_Arrived_Table_today = document.getElementById("arrived_today");

    //Departed tables
    var show_Departed_Table_Today = document.getElementById("departed_today");
    var show_all_table_departed = document.getElementById("departed_all");

    show_Expected_Table_Today.style.display="none";
    show_all_table_expected.style.display = "none";

    show_all_table_departed.style.display = "none";
    show_Departed_Table_Today.style.display="none";

    show_Arrived_Table_today.style.display = "table";

}


function departed_today() {
    var show_Expected_Table_Today = document.getElementById("expected_today");
    var show_all_table_expected = document.getElementById("expected_all");

    //arrived Tables
    var show_Arrived_Table_today = document.getElementById("arrived_today");

    //Departed tables
    var show_Departed_Table_Today = document.getElementById("departed_today");
    var show_all_table_departed = document.getElementById("departed_all");

    show_Expected_Table_Today.style.display="none";
    show_all_table_expected.style.display = "none";

    show_Arrived_Table_today.style.display = "none";

    show_all_table_departed.style.display = "none";
    show_Departed_Table_Today.style.display="table";

}

function departed_all() {
    var show_Expected_Table_Today = document.getElementById("expected_today");
    var show_all_table_expected = document.getElementById("expected_all");

    //arrived Tables
    var show_Arrived_Table_today = document.getElementById("arrived_today");

    //Departed tables
    var show_Departed_Table_Today = document.getElementById("departed_today");
    var show_all_table_departed = document.getElementById("departed_all");

    show_Expected_Table_Today.style.display="none";
    show_all_table_expected.style.display = "none";

    show_Arrived_Table_today.style.display = "none";


    show_Departed_Table_Today.style.display="none";
    show_all_table_departed.style.display = "table";
}
function expected_today() {
    //expected tables
    var show_Expected_Table_Today = document.getElementById("expected_today");
    var show_all_table_expected = document.getElementById("expected_all");

    //arrived Tables
    var show_Arrived_Table_today = document.getElementById("arrived_today");

    //Departed tables
    var show_Departed_Table_Today = document.getElementById("departed_today");
    var show_all_table_departed = document.getElementById("departed_all");

    show_Arrived_Table_today.style.display = "none";

    show_Departed_Table_Today.style.display="none";
    show_all_table_departed.style.display = "none";

    show_all_table_expected.style.display = "none";
    show_Expected_Table_Today.style.display="table";

}


function expected_all() {
    //expected tables
    var show_Expected_Table_Today = document.getElementById("expected_today");
    var show_all_table_expected = document.getElementById("expected_all");


    //arrived Tables
    var show_Arrived_Table_today = document.getElementById("arrived_today");

    //Departed tables
    var show_Departed_Table_Today = document.getElementById("departed_today");
    var show_all_table_departed = document.getElementById("departed_all");

    show_Arrived_Table_today.style.display = "none";

    show_Departed_Table_Today.style.display="none";
    show_all_table_departed.style.display = "none";

    show_Expected_Table_Today.style.display="none";
    show_all_table_expected.style.display = "";
}


function in_advance_Check_in() {
    //expeted tables
    var show_Expected_Table_Today = document.getElementById("expected_today");
    var show_all_table_expected = document.getElementById("expected_all");
    var show_form_check_in = document.getElementById("check_in");
    var show_div_for_Tables = document.getElementById("tableDiv2");

    //arrived Tables
    var show_Arrived_Table_today = document.getElementById("arrived_today");

    //Departed tables
    var show_Departed_Table_Today = document.getElementById("departed_today");
    var show_all_table_departed = document.getElementById("departed_all");

    show_Arrived_Table_today.style.display = "none";

    show_Departed_Table_Today.style.display="none";
    show_all_table_departed.style.display = "none";

    show_Expected_Table_Today.style.display="none";
    show_all_table_expected.style.display = "none";
    show_div_for_Tables.style.display = "none";
    show_form_check_in.style.display = "";

}





function findGuests() {
    var table;
    var expected_today = document.getElementById("expected_today");
    var departed_all = document.getElementById("departed_all");
    var departed_today = document.getElementById("departed_today");
    var arrived = document.getElementById("arrived_today");
    var expected_all_form = document.getElementById("expected_all");
    var expected_all_table = document.getElementById("expected_all_table");

    // Declare variables
    //expected All
    if (expected_today.style.display == "none" && arrived.style.display == "none" && departed_today.style.display == "none" && departed_all.style.display == "none"  ){
        table = expected_all_table;
    } else if ( expected_all_form.style.display == "none" && arrived.style.display == "none" && departed_today.style.display == "none" && departed_all.style.display == "none"  ){
        table = expected_today;
    } else if (expected_today.style.display == "none" && arrived.style.display == "none" && expected_all_form.style.display == "none" && departed_all.style.display == "none"  ){
        table = departed_today;
    }else if (expected_today.style.display == "none" && arrived.style.display == "none" && expected_all_form.style.display == "none" && departed_today.style.display == "none"  ){
        table = departed_all;
    }else if (expected_today.style.display == "none" && departed_all.style.display == "none" && expected_all_form.style.display == "none" && departed_today.style.display == "none"  ){
        table = arrived;
    } else {
        alert("Noget gik galt ");
        window.location = "guests";
    }
    var input, filter, tr, td, i, txtValue;
    input = document.getElementById("input-box");
    filter = input.value.toUpperCase();
    tr = table.getElementsByTagName("tr");
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

function move_person(card,row, id){
}
