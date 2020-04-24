



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

function get_select_values(card) {
   var values = [];
    var select = document.getElementById('cardIsPicked');
    for (var i=1; i < select.options.length; i++){
        if (card == select.options[i].value ){
            var s = "Denne værdi indsættes ikke";
        } else {
        var value = select.options[i].value;
        values.push(value)
        }
    }


    return values
}

function update_select(values){
    var select = document.getElementById('cardIsPicked');
    select.options.length =0;
   select.options.length = values.length+1;
    select.options[0].text = "Vælg dit Id kort her....";
    select.options[0].value = "";
    for (var n = 0; n < values.length; n++){
        var value = values[n];
         var text = values[n].toString();
        select.options[n+1].value = value;
        select.options[n+1].text = text;
    }
}

function deleteRow(row) {
    alert("hej1");
    var i = row.parentNode.parentNode.rowIndex;
    alert(i);
    document.getElementById("searchIn").deleteRow(i);
    alert("hej2");
    document.getElementById("guestInputCheckIn").value ='';
    alert("hej3");

}

function insertRow(card, name) {
    var table_check_out = document.getElementById("searchOut");
    var num = table_check_out.rows.length;
    alert(num);
    table_check_out.insertRow(num);
    var row = table_check_out.rows[num];
    row.style.width ="100%";
    row.style.height ="100%";
    alert("Vi er ved Row1");
    var cell1 = row.insertCell(0);
    alert("Vi er ved Row2");
    var cell2 = row.insertCell(1);
    alert("Vi er ved Row3");

    cell1.style.boxShadow = "0 0 0 0.2rem black";
    cell1.style.backgroundColor = "white";
    cell1.style.width = "75%";

    cell2.style.backgroundColor = "white";
    cell2.style.width = "75%";
    cell2.style.boxShadow = "0 0 0 0.2rem black";
    cell1.innerHTML = "<h3 style='font-weight: 900; text-align: center; color: black ' >"+  name + "</h3>";
    cell2.innerHTML = "<h3 style='font-weight: 900; text-align: center; color: black ' >"+  card + "</h3>";


}

function guest_Check_in(id, row, name){
    $('#executeCheckIn').submit(function (e) {
        var selObj = document.getElementById('cardIsPicked');
        var txtValueObj = document.getElementById('txtValue');
        var selIndex = selObj.selectedIndex;
        var guestCardID = txtValueObj.value = selObj.options[selIndex].value;
        var values = get_select_values(guestCardID);
        var route = $('#executeCheckIn').data('route');
        var form_data = $(this);
        $.ajax({
            type: 'put' ,
            url: "/guests/" + id + "/" + guestCardID + "/edit",
            data: form_data.serialize(),
            success: function(data) {
                alert("Hej");
               update_select(values);
                deleteRow(row);
                insertRow(guestCardID, name);
                alert("Du er hermed registreret! Du ønskes en rigtig god dag ");

            }
        });
        e.preventDefault();

    });
}

function guest_Check_out(guest_id, card_id, row){
    $('#executeCheckOut').submit(function (e) {
        var route = $('#executeCheckOut').data('route');
        var form_data = $(this);
        $.ajax({
            type: 'put' ,
            url: "/guests/" + guest_id + "/" + card_id + "/edit",
            data: form_data.serialize(),
            success: function(data) {
                var i = row.parentNode.parentNode.rowIndex;
                document.getElementById("searchOut").deleteRow(i);
                alert("Du er hermed checket ud! Håber du har haft et godt besøg!")
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
    var show_form_check_in = document.getElementById("check_in");
    var show_in_advance_check_out = document.getElementById("check_out_in_advance");
    var show_div_for_Tables = document.getElementById("tableDiv2");
    //arrived Tables
    var show_Arrived_Table_today = document.getElementById("arrived_today");
    //Departed tables
    var show_Departed_Table_Today = document.getElementById("departed_today");
    var show_all_table_departed = document.getElementById("departed_all");
    show_div_for_Tables.style.display = "";

    show_Departed_Table_Today.style.display="none";

    show_in_advance_check_out.style.display ="none";
    show_form_check_in.style.display = "none";
    show_all_table_expected.style.display = "none";
    show_Expected_Table_Today.style.display="none";
    show_all_table_departed.style.display = "none";

    show_Arrived_Table_today.style.display = "table";

}


function departed_today() {
    var show_Expected_Table_Today = document.getElementById("expected_today");
    var show_all_table_expected = document.getElementById("expected_all");
    var show_form_check_in = document.getElementById("check_in");
    var show_in_advance_check_out = document.getElementById("check_out_in_advance");
    var show_div_for_Tables = document.getElementById("tableDiv2");
    //arrived Tables
    var show_Arrived_Table_today = document.getElementById("arrived_today");
    //Departed tables
    var show_Departed_Table_Today = document.getElementById("departed_today");
    var show_all_table_departed = document.getElementById("departed_all");
    show_div_for_Tables.style.display = "";
    show_Arrived_Table_today.style.display = "none";


    show_in_advance_check_out.style.display ="none";
    show_form_check_in.style.display = "none";
    show_all_table_expected.style.display = "none";
    show_Expected_Table_Today.style.display="none";
    show_all_table_departed.style.display = "none";

    show_Departed_Table_Today.style.display="table";

}


function expected_today() {
    //expected tables
    var show_Expected_Table_Today = document.getElementById("expected_today");
    var show_all_table_expected = document.getElementById("expected_all");
    var show_form_check_in = document.getElementById("check_in");
    var show_in_advance_check_out = document.getElementById("check_out_in_advance");
    var show_div_for_Tables = document.getElementById("tableDiv2");
    //arrived Tables
    var show_Arrived_Table_today = document.getElementById("arrived_today");
    //Departed tables
    var show_Departed_Table_Today = document.getElementById("departed_today");
    var show_all_table_departed = document.getElementById("departed_all");
    show_div_for_Tables.style.display = "";
    show_Arrived_Table_today.style.display = "none";

    show_Departed_Table_Today.style.display="none";

    show_in_advance_check_out.style.display ="none";
    show_form_check_in.style.display = "none";
    show_all_table_expected.style.display = "none";
    show_all_table_departed.style.display = "none";


    show_Expected_Table_Today.style.display="table";

}



function departed_all() {
    var show_Expected_Table_Today = document.getElementById("expected_today");
    var show_all_table_expected = document.getElementById("expected_all");
    var show_form_check_in = document.getElementById("check_in");
    var show_in_advance_check_out = document.getElementById("check_out_in_advance");
    var show_div_for_Tables = document.getElementById("tableDiv2");
    //arrived Tables
    var show_Arrived_Table_today = document.getElementById("arrived_today");
    //Departed tables
    var show_Departed_Table_Today = document.getElementById("departed_today");
    var show_all_table_departed = document.getElementById("departed_all");
    show_div_for_Tables.style.display = "";
    show_Arrived_Table_today.style.display = "none";

    show_Departed_Table_Today.style.display="none";

    show_in_advance_check_out.style.display ="none";
    show_form_check_in.style.display = "none";
    show_all_table_expected.style.display = "none";
    show_Expected_Table_Today.style.display="none";

    show_all_table_departed.style.display = "table";
}

function expected_all() {
    var show_Expected_Table_Today = document.getElementById("expected_today");
    var show_all_table_expected = document.getElementById("expected_all");
    var show_form_check_in = document.getElementById("check_in");
    var show_in_advance_check_out = document.getElementById("check_out_in_advance");
    var show_div_for_Tables = document.getElementById("tableDiv2");
    //arrived Tables
    var show_Arrived_Table_today = document.getElementById("arrived_today");
    //Departed tables
    var show_Departed_Table_Today = document.getElementById("departed_today");
    var show_all_table_departed = document.getElementById("departed_all");
    show_div_for_Tables.style.display = "";
    show_Arrived_Table_today.style.display = "none";

    show_Departed_Table_Today.style.display="none";
    show_all_table_departed.style.display = "none";

    show_Expected_Table_Today.style.display="none";

    show_in_advance_check_out.style.display ="none";
    show_form_check_in.style.display = "none";

    show_all_table_expected.style.display = "";
}


function in_advance_Check_in() {
    var show_Expected_Table_Today = document.getElementById("expected_today");
    var show_all_table_expected = document.getElementById("expected_all");
    var show_form_check_in = document.getElementById("check_in");
    var show_in_advance_check_out = document.getElementById("check_out_in_advance");
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
    show_in_advance_check_out.style.display ="none";

    show_form_check_in.style.display = "";
}


function check_out_from_admin() {
    //expeted tables
    var show_Expected_Table_Today = document.getElementById("expected_today");
    var show_all_table_expected = document.getElementById("expected_all");
    var show_form_check_in = document.getElementById("check_in");
    var show_in_advance_check_out = document.getElementById("check_out_in_advance");
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
    show_form_check_in.style.display = "none";

    show_in_advance_check_out.style.display ="";
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

function f(guests) {
    $.ajax({
        type: 'GET' ,
        dataType: 'json',
        url: "/ajaxRequest/guests",
        success: function(data) {
            alert("Vi er igennem");
            var data2 = JSON.parse(data);
            alert(data2);
        },
    });

    alert(guests);
var table = document.getElementById("check_in_table_body");
$('#check_in_table_body').empty();


var newRow   = table.insertRow();
var newCell1 = newRow.insertCell(0);
var newCell2 = newRow.insertCell(1);
var newCell3 = newRow.insertCell(2);
// Append a text node to the cell
    var newText1  = document.createTextNode('Jesper');
    var newText2  = document.createTextNode('Virksomhed');
    var newText3  = document.createTextNode('kort id');
    newCell1.appendChild(newText1);
    newCell2.appendChild(newText2);
    newCell3.appendChild(newText3);
}

function execute_alert(card, id) {
    var txt;
    if (confirm("Press a button!")) {
        txt = "You pressed OK!";
        move_person(card, id)
    } else {
        txt = "You pressed Cancel!";
        document.getElementById("execute_move").action = "guestsRegistration";
        document.getElementById("tableDiv2").style.display = "none";
    }
}

function select_row(id) {
var checkbox = "checkbox" + id;
if (document.getElementById(checkbox).checked == true){
    document.getElementById(checkbox).checked = false;
    document.getElementById(checkbox).setAttribute("value", "false");
}else if (document.getElementById(checkbox).checked == false)
    document.getElementById(checkbox).checked = true;
    document.getElementById(checkbox).setAttribute("value", "true");
}


function move_person() {
    var table = document.getElementById("check_in_table_body");
    var persons =[];
    var cards =[];
    for (var i = 0; i<table.rows.length; i++){
        var id = table.rows[i].cells.item(0).innerHTML;
        var check_if_checked = "checkbox"+id;
        if (document.getElementById(check_if_checked).getAttribute("value") == "true"){
            var selected_index = document.getElementById(id).options[document.getElementById(id).selectedIndex].value;
            var guest = {id: id, card: selected_index };

            persons.push(id);
            cards.push(selected_index);

        }else {
            var c = "Vi indsætter ikke uvæstnlige rækker ";
    }
    }
    alert("Jeg er hermed landet her");
    $('#execute_move').submit(function (e) {
        var route = $('#execute_move').data('route');
        var form_data = $(this);
        var data = persons;
        var data2 = cards;
        $.ajax({
            type: 'put',
            url: "/guests/edit",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: { arr: data, arr2: data2},
            success: function (data) {
                $("#check_in_table").load(window.location + " #check_in_table");
            }, onFailure: function (data)
            {
               window.location = "guests";
            }
        });
        e.preventDefault()
    });



}



function creat_select_on_row(card, row){
        row.deleteCell(4);

    var select = document.createElement("select");
    var option = document.createElement("option");
    select.setAttribute("class", "custom-select");
    select.setAttribute("id", "cardIsPicked2");
    select.style.marginLeft = "9%";
    select.style.marginTop = "5%";
    select.style.width = "92px";
    select.style.height = "67%";
    option.value = card;
    option.text = card;
    select.add(option, select[0]);
    cell = row.insertCell(4);
    cell.appendChild(select);
}

    function adjust_table_cards(id, card_chosen){
    var table = document.getElementById("check_in_table_body");
    var row;
    var i;
    var n;
    var row2;
    var card;
    var card_numbers_array = [];
    var person_id_list =[];
        for (i = 1; i<= document.getElementById(id).options.length-1; i++){
            var card = document.getElementById(id).options[i].value;
            if (card_chosen == card){
                var p = "no push";
            } else
                card_numbers_array.push(card);
        }
        for (n = 0; n < table.rows.length; n++) {
            row2 = table.rows[n].cells.item(0).innerHTML;
            person_id_list.push(row2);
        }

        return card_numbers_array;
    }

function refresh_tables(cards_values, card){
    var count;
    var row;
    var cell;
    var test ="true";
    var table = document.getElementById("check_in_table_body");
        for (count = 0; count < table.rows.length; count++) {
            alert(cards_values);
            if ( test == table.rows[count].getAttribute("name")){
                alert(table.rows[count].getAttribute("name"))
                var c = "Vi sletter ikke noget i denne celle";
            }else {
                table.rows[count].deleteCell(4);
            }
        }
            var select_created;
            var cell;
            for (var new_count = 0; new_count < table.rows.length; new_count++){
                if (test == table.rows[new_count].getAttribute("name")){
                    var w = "Vi indsætter ike noget i denne celle"
                }else {
                    select_created = make_select(cards_values);
                    cell = table.rows[new_count].insertCell(4);
                    cell.appendChild(select_created);
                }

            }

}

function make_select(cards_values) {
    var select = document.createElement("select");
    var option = document.createElement("option");
    select.setAttribute("class", "custom-select");
    select.setAttribute("id", "cardIsPicked2");
    select.style.marginLeft = "9%";
    select.style.marginTop = "5%";
    select.style.width = "92px";
    select.style.height = "67%";
    option.text ="Id-kort";
    select.add(option, select[0]);

    for (var j = 0; j < cards_values.length; j++) {
        var option_values = make_option(cards_values[j]);
        select.add(option_values, select[j]);
    }
    return select;
}


function make_option( value){
    var option = document.createElement("option");
        option.value = value;
        option.text = value;
    return option
}

function adjust_table(){
    var table = document.getElementById("check_in_table_body");
    var row;
    var n;
    var person_id_list =[];
    for (n = 0; n < table.rows.length; n++) {
        row = table.rows[n].cells.item(0).innerHTML;
        person_id_list.push(row);
    }
    return person_id_list;
}


$(function() {
    alert("hej");
    enable_cb();
    $("#group1").click(enable_cb);
});


function transfer_guest_data( id ,name, company){
    document.getElementById("company_input_field").value = company;
    document.getElementById("name_input_field").value = name;
    document.getElementById("id_of_guest_to_change").value = id;
}

function update_guest_info(){
    var form = document.getElementById("form-data_change_guest_info");
    var company =document.getElementById("company_input_field").value;
    var name = document.getElementById("name_input_field").value;
    var id = document.getElementById("id_of_guest_to_change").value;

    form.action = "guests/update/" +id +"/" + name + "/" + company;
}




