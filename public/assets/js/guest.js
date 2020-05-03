
function searchForGuest_updated() {
    // Declare variables
    var input, table, filter, tr, td, i, txtValue ;
        table = document.getElementById("search_In");
        input = document.getElementById("guest_Input_CheckIn");
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
    checkBox_check_in()
}



function searchForGuest_updated_out() {
    // Declare variables
    var input, table, filter, tr, td, i, txtValue ;
    table = document.getElementById("search_Out_body");
    input = document.getElementById("guest_Input_CheckOut");
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
    checkBox_check_out()
}

function checkBox_check_in() {
    if (document.getElementById("guest_Input_CheckIn").value == '' ){
        document.getElementById("search_In").style.display = "none";
}
}

function checkBox_check_out() {
    if (document.getElementById("guest_Input_CheckOut").value == '' ){
        document.getElementById("search_Out_body").style.display = "none";
    }
}





function check_in_guest(guestId, company) {
    var form = document.getElementById("execute_Check_In");
    var selObj = document.getElementById('cardIsPicked_new');
    var txtValueObj = document.getElementById('txtValue_new');
    var selIndex = selObj.selectedIndex;
    var guestCardID = txtValueObj.value = selObj.options[selIndex].value;
    form.action = "checkIn/" + guestId + "/" + guestCardID;
}




function create_and_check_in() {
       $('#form-data-create').submit(function (e) {
        var guestId;
           var route = $('#form-data-create').data('route');
        var form_data = $(this);
           var name = document.getElementById("unexpected_Guest").value;
        var company = document.getElementById("unexpectedGuest_company").value;
        $.ajax({
            type: 'post',
            url: "/guestMenu/fastCreate",
            data: form_data.serialize(),
            success: function (data) {
                alert("hallo");
                var id = data[0];
                var card = data[1];
                alert(id + " " + card);
                var route = $('#form-data-update').data('route');
                var form_data_put = $(this);
                $.ajax({
                    type: 'put',
                    url: '/guestMenu/fastupdate/' + card +"/" + id,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: form_data_put.serialize(),
                    success: function (data) {
                        alert("Du er checket ind");
                        location.reload();
                    }
                });
            },
        });
        e.preventDefault();

    })
}
