

function sort_update_page(table_id) {
    var employee_change_table = document.getElementById("change_employee");
    var employee_delete_table = document.getElementById("delete_employee");
    var guest_change_table = document.getElementById("change_guest");
    var guest_delete_table = document.getElementById("delete_guest");
    var card_delete_table = document.getElementById("delete_guestCard_table");
    var own_info = document.getElementById("own_info_div");
    var make_card = document.getElementById("make_card_div");

    var headline_1 = document.getElementById("change_info_empployee");
    var headline_2 = document.getElementById("remove_employee");
    var headline_3 = document.getElementById("change_info_guest");
    var headline_4 = document.getElementById("remove_guest");
    var headline_5 = document.getElementById("own_info_headline");
    var headline_6 = document.getElementById("create_guest_card");
    var headline_7 = document.getElementById("delete_guest_card");


    if (table_id == 1){
        make_card.style.display = "none";
        own_info.style.display = "none";
        employee_delete_table.style.display = "none";
        guest_change_table.style.display = "none";
        guest_delete_table.style.display = "none";
        card_delete_table.style.display = "none";
        headline_2.style.display = "none";
        headline_3.style.display="none";
        headline_4.style.display = "none";
        headline_5.style.display = "none";
        headline_6.style.display = "none";
        headline_7.style.display = "none";
        employee_change_table.style.display="table";
        headline_1.style.display = "";

    }else if (table_id == 2){
        make_card.style.display = "none";
        own_info.style.display = "none";
        employee_change_table.style.display="none";
        guest_delete_table.style.display = "none";
        guest_change_table.style.display = "none";
        card_delete_table.style.display = "none";
        headline_1.style.display = "none";
        headline_3.style.display="none";
        headline_4.style.display = "none";
        headline_5.style.display = "none";
        headline_6.style.display = "none";
        headline_7.style.display = "none";


        employee_delete_table.style.display = "table";
        headline_2.style.display = "";
    }else  if (table_id == 3){
        make_card.style.display = "none";
        own_info.style.display = "none";
        employee_delete_table.style.display = "none";
        employee_change_table.style.display="none";
        card_delete_table.style.display = "none";
        guest_delete_table.style.display = "none";
        headline_1.style.display = "none";
        headline_2.style.display="none";
        headline_4.style.display = "none";
        headline_5.style.display = "none";
        headline_6.style.display = "none";
        headline_7.style.display = "none";


        guest_change_table.style.display = "table";
        headline_3.style.display = "";
    } else if (table_id == 4){
        make_card.style.display = "none";
        own_info.style.display = "none";
        employee_delete_table.style.display = "none";
        employee_change_table.style.display="none";
        guest_change_table.style.display = "none";
        card_delete_table.style.display = "none";
        headline_1.style.display = "none";
        headline_2.style.display="none";
        headline_3.style.display = "none";
        headline_5.style.display = "none";
        headline_6.style.display = "none";
        headline_7.style.display = "none";


        guest_delete_table.style.display = "table";
        headline_4.style.display = "";

    }else if (table_id == 5){
        make_card.style.display = "none";
        employee_delete_table.style.display = "none";
        employee_change_table.style.display="none";
        guest_change_table.style.display = "none";
        card_delete_table.style.display = "none";
        headline_1.style.display = "none";
        headline_2.style.display="none";
        headline_3.style.display = "none";
        guest_delete_table.style.display = "none";
        headline_4.style.display = "none";
        headline_6.style.display = "none";
        headline_7.style.display = "none";


        headline_5.style.display = "";
        own_info.style.display = "";
    }else if (table_id == 6){
        employee_delete_table.style.display = "none";
        employee_change_table.style.display="none";
        guest_change_table.style.display = "none";
        headline_1.style.display = "none";
        headline_2.style.display="none";
        headline_3.style.display = "none";
        guest_delete_table.style.display = "none";
        card_delete_table.style.display = "none";
        headline_4.style.display = "none";
        headline_5.style.display = "none";
        headline_7.style.display = "none";
        own_info.style.display = "none";

        headline_6.style.display = "";
        make_card.style.display = "";
    }else if (table_id == 7){
        employee_delete_table.style.display = "none";
        employee_change_table.style.display="none";
        guest_change_table.style.display = "none";
        headline_1.style.display = "none";
        headline_2.style.display="none";
        headline_3.style.display = "none";
        guest_delete_table.style.display = "none";
        headline_4.style.display = "none";
        headline_5.style.display = "none";
        own_info.style.display = "none";
        headline_6.style.display = "none";
        make_card.style.display = "none";

        headline_7.style.display = "";
        card_delete_table.style.display = "table";
    }
    else {
        make_card.style.display = "none";
        own_info.style.display = "none";
        employee_delete_table.style.display = "none";
        guest_change_table.style.display = "none";
        guest_delete_table.style.display = "none";
        card_delete_table.style.display = "none";
        headline_2.style.display = "none";
        headline_3.style.display="none";
        headline_4.style.display = "none";
        employee_change_table.style.display="table";
        headline_1.style.display = "";
    }

}



function transfer_data_employee( id, name, email, password,  type){
    alert(type);
    if (type ==1 ){
    document.getElementById("name_employee_field").value = name;
    document.getElementById("email_employee_field").value = email;
    document.getElementById("password_employee_field").value = password;
    document.getElementById("id_of_employee").value = id;
    } else if (type == 2){
        document.getElementById("name_employee_field_delete").value = name;
        document.getElementById("email_employee_field_delete").value = email;
        document.getElementById("password_employee_field_delete").value = password;
        document.getElementById("id_of_employee_delete").value = id;
    }
}


function transfer_data_guest( id, name, company, type){
    if (type == 1) {
        document.getElementById("guest_company_field").value = company;
        document.getElementById("guest_name_field").value = name;
        document.getElementById("id_of_guest_to_change").value = id;
    } else if( type == 2){
            document.getElementById("guest_company_field_delete").value = company;
            document.getElementById("guest_name_field_delete").value = name;
            document.getElementById("id_of_guest_to_change_delete").value = id;
        }


}


function showPassword() {
    var x = document.getElementById("password_employee_field");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

function transfer_info_employee(employee_position) {

 var input_field = document.getElementById("input_employee_position");
 input_field.value = employee_position;
 input_field.style.display = "";

}

function make_employee(employee_position){
    var type;
    var form = document.getElementById("make_employee_form");
if (employee_position == "Administrator"){
     type = 2;
}else  if (employee_position == "Øvrige medarbejdere"){
     type = 1;
}
alert(type);
    form.action = "createEmployee/"+type;
}
