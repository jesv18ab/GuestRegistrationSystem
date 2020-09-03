<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Guest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\Types\Boolean;
use function GuzzleHttp\Psr7\str;
use Auth;

class AdminController extends Controller
{

    public function multiple_check_in(Request $request){
        $return = null;
        if (auth()->user()->isAdmin() == 2){
            $cards = $request->get('arr2');
            $persons = $request->get('arr');
            $number_of_cards =count($persons);
            for ($i = 0; $i< $number_of_cards; $i++){
                $id = $persons[$i];
                $card = $cards[$i];
                DB::update("UPDATE guest_cards SET status = 2, guestId = $id where id =$card ");
                DB::update("UPDATE guests SET updated_at = now(), time_updated = CURRENT_TIME, status = 2 where guests.id = $id");
         $return =  response("hej hej");;
            }
        }else{
            $return = redirect("registerGuest");
        }
        return $return;
    }


    public function multiple_check_Out(Request $request){
        $return = null;
        if (auth()->user()->isAdmin() == 2){
            $cards = $request->get('arr2');
            $persons = $request->get('arr');
            $number_of_cards =count($persons);
            for ($i = 0; $i< $number_of_cards; $i++){
                $id = $persons[$i];
                $card = $cards[$i];
                DB::update("UPDATE guest_cards SET status = 1, guestId = null where id = $card");
                DB::update("UPDATE guests SET time_updated = null, time_created = null, departed_at = now(), time_departed = CURRENT_TIME, status = 3 where guests.id = $id");
                $return =  response("hej hej");;
            }
        }else{
            $return = redirect("registerGuest");
        }
        return $return;
    }



    public function index()
    {
        $return = null;
        if (auth()->user()->isAdmin() == 2){
            $data = DB::select("select * from guests where created_at = curdate() AND status = 1");
            $guests_Today_Check_In = $this->correctDateFormat($data);

            $data = DB::select("Select guests.name, guestId, guest_cards.id, guests.updated_at, guests.time_updated, guests.created_at, guests.departed_at   from guest_cards inner join guests where guests.id = guest_cards.guestId and guests.updated_at = curdate() AND guests.status = 2");
            $guests_Today_arrived = $this->correctDateFormat($data);


            $data=DB::select('select * from guests where status = 1');$this->correctDateFormat($data);
            $guestsExpected = $this->correctDateFormat($data);

            $data = DB::select('select * from guests where status = 2');
            $guestsCheckedIn = $this->correctDateFormat($data);

            $data =  DB::select('select * from guests where status = 3 and departed_at = curdate()');
            $guests_Today_Checked_Out = $this->correctDateFormat($data);

            $data = DB::select('select * from guests where status = 3');
            $guestsCheckedOut = $this->correctDateFormat($data);

            $cardsAvailable   = DB::select('select * from guest_cards where status = 1');
            $return = view('AdminView.index', ['guests' => $guestsExpected, 'guestsCheckedIn' => $guestsCheckedIn, 'guestsCheckedOut' => $guestsCheckedOut, "guests_Today_Check_In"=>$guests_Today_Check_In, "guests_Today_arrived" => $guests_Today_arrived, "guests_Today_Checked_Out"=>$guests_Today_Checked_Out, "cardsAvailable"=> $cardsAvailable  ] );
        }else{
            $return = redirect("registerGuest");
        }

        return $return;
    }


    public function create_view(){
        $return = null;
        if (auth()->user()->isAdmin() == 2){
            $return = view('AdminView.newEmployeeView');
        }else{
            $return = redirect("registerGuest");
        }

        return $return;
    }

    public function update_page(){
        $return = null;
        if (auth()->user()->isAdmin() == 2){
            $currentUser = auth()->user();
            $guests = DB::select('select * from guests');
            $employees = DB::select('select * from users where type=2');
            $guestcards_available = DB::select('select * from guest_cards where status=1');
            $guestcards_all = DB::select('select * from guest_cards ');
            $return = view('AdminView.updateInfo',['guests'=> $guests, 'employees'=>$employees, 'currentUser'=>$currentUser, 'guestcards_available'=>$guestcards_available, 'guestcards_all'=>$guestcards_all   ]);
        }else{
            $return = redirect("registerGuest");
        }
        return $return;
    }

    public function update_user_info(){
        $return = null;
        if (auth()->user()->isAdmin() == 2){
            $type = request('type');
            if ($type ==1 ){
                $name = request('employeeName');
                $password = Hash::make( request("employeePassword"));
                $email = request('employeeEmail');
                $id = request('employeeId');
                DB::update("UPDATE users set name ='$name', email = '$email',  password = '$password'  where id = $id");
            }else if ($type == 2){
                $name = request('guestName');
                $company = request("guestCompany");
                $id = request('guestId');
                DB::update("UPDATE guests set name ='$name', company ='$company'  where id = $id");
            }
          $return = redirect('/updateUsers');
        }
        else{
            $return = redirect("registerGuest");
        }
        return $return;
    }

    public function delete_employee(){
        $return = null;
        if (auth()->user()->isAdmin() == 2){
            $id = request("employeeId");
            DB::delete("delete from users where id =$id");
            session()->flash('employeedeleteSuccess', 'Personen er hermed fjernet fra systemet');
            $return = redirect('/updateUsers');
        } else{
            $return = redirect('/registerGuest');
        }
        return $return;
    }

    public function delete_guest(){
        $return = null;
        if (auth()->user()->isAdmin() == 2){
            $id = request("guestId");
            DB::delete("delete from guests where id =$id");
            session()->flash('guestdeleteSuccess', 'Gæsten er hermed slettet fra systemet');
            $return = redirect('/updateUsers');
        }else{
            $return = redirect('/registerGuest');
        }
        return $return;
    }

    public function create_employee($type){
        $return = null;
        if (auth()->user()->isAdmin() == 2){
            request()->validate(['firstname'=> 'required|regex:/^[\pL\s\-]+$/u', 'lastname'=>'required', 'email'=>'regex:/^.+@.+$/i', 'created_at'=> 'required', 'password'=>'string', 'min:8', 'confirm', 'position'=>'required'  ]);
            $user = new User();
            $firstname = request('firstname');
            $lastname = request('lastname');
            $user->name = $firstname. ' ' . $lastname;
            $user->email = request('email');
            $user->password = Hash::make(request('password'));
            $user->type = $type;
            $user->save();
            $return = redirect('createEmployeeView');;
        } else{
            $return = redirect('/registerGuest');
        }

        return $return;
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/login');
    }

    public function make_card(){
        $return = null;
        $card_id = null;
        if (auth()->user()->isAdmin() == 2){
            request()->validate(['Id'=> 'required', 'digits_between:3,10' ]);
            $card_id = request("Id");
            if ($this->validateCard($card_id) == false){
                $return = redirect("/home");
            }
            else{
                DB::insert("insert into guest_cards (id)  values($card_id)");
                $return = redirect("updateUsers");}
        } else{
                $return = redirect('/registerGuest');
            }
        return $return;
    }

    public function update_admin_info(){
        $return = null;
        if (auth()->user()->isAdmin() == 2){
        $name = request("own_name_change");
        $email = request("own_email_change");
        $old_password = request("old_password");
        $new_password = request("new_password");
        $new_password_repeat = request("new_password_repeat");
        if (!$old_password == null){
          if ($this->validateCredentials($old_password, $new_password, $new_password_repeat) == true){
              $id = auth()->user()->id;
             $hashed_password =  Hash::make($new_password_repeat);
              DB::update("UPDATE users set name ='$name', email = '$email', password = '$hashed_password' where id = $id");
              $return = redirect('/updateUsers');
          }  else{
              $return = redirect('/registerGuest');
          }
        }else{
            $id = auth()->user()->id;
            DB::update("UPDATE users set name ='$name', email = '$email'  where id = $id");
            $return = redirect('/updateUsers');
        }
    }else{
            $return = redirect('/registerGuest');
        }

        return $return;
    }

    public function delete_card(){
        $return = null;
        if (auth()->user()->isAdmin() == 2){
            $card = request("card");
            DB::delete("delete from guest_cards where id = $card");
            $return  = redirect("updateUsers");
        } else{
            $return = redirect('/registerGuest');
        }
        return $return;
    }

    //Validate functions
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

    public function validateCard($card_id)
    {
        $counter = 0;
        $check = null;
        $guestcards_all = DB::select('select * from guest_cards ');
        foreach ($guestcards_all as $card) {
            if ($card_id == $card->id) {
                $counter++;
            }
        }
        if (!$counter == 0){
            $check = false;
        }else{
            $check = true;
        }

        return $check;
    }

    public function correctDateFormat($unFormatted){
        $formatted = [];
        foreach ($unFormatted as $toFormat){
            $toFormat->created_at = date_create($toFormat->created_at)->format('d-m-y');
            $toFormat->updated_at = date_create($toFormat->updated_at)->format('d-m-y');
            $toFormat->departed_at = date_create($toFormat->departed_at)->format('d-m-y');
            array_push($formatted, $toFormat);
        }
        return $formatted;
    }
}
