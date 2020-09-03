<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use phpDocumentor\Reflection\Types\Boolean;

class EmployeeController extends Controller
{



    public function show_todays_Agreements(){

        $user_id =auth()->user()->id;
        $list_of_guests = DB::select("select guests.name, guests.created_at, guests.time_created, guests.company from appointments inner join guests on guests.id = guestId inner join users on users.id = userId where userId=$user_id AND guests.created_at = curdate() AND guests.status = 1");
        return View("EmployeeView.EmployeeGuestView", ['list_of_guests'=>$list_of_guests]);
    }

    public function show_profile(){
        $currentUser = auth()->user();
        return view('EmployeeView.update_profile', ['currentUser'=>$currentUser]);
    }
    public function update_employee_info(){
        $return = null;
        $name = request("name");
        $email = request("email");
        $old_password = request("old_password");
        $new_password = request("new_password");
        $new_password_repeat = request("new_password_repeat");
        if (!$old_password == null){
            if ($this->validateCredentials($old_password, $new_password, $new_password_repeat) == true){
                $id = auth()->user()->id;
                $hashed_password =  Hash::make($new_password_repeat);
                DB::update("UPDATE users set name ='$name', email = '$email', password = '$hashed_password'  where id = $id");
                $return = redirect('/updateProfile');
            }  else{
                $return = redirect('/registerGuest');
            }
        }else{
            $id = auth()->user()->id;
            DB::update("UPDATE users set name ='$name', email = '$email'  where id = $id");
            $return = redirect('/updateProfile');
        }
        return $return;
    }
    public function validateCredentials($old_password, $new_password, $new_password_repeat){
        $check = new Boolean();
        $user = auth()->user();
        if (Hash::check($old_password, auth()->user()->password) == true ){
            if ($new_password == $new_password_repeat){
                $check = true;
            }else{
                $check = false;
            }
        }else{
            $check = false;
        }
        return $check;
    }


}
