<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Guest;
use App\GuestCard;
use http\Env\Response;
use http\Message;
use Illuminate\Http\Request;
use App\Article;
use App\Tag;
use Illuminate\Pagination\UrlWindow;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Null_;
use PhpParser\Node\Expr\List_;
use function GuzzleHttp\Psr7\str;
use function MongoDB\BSON\toJSON;
use function Sodium\add;
use Auth;

class GuestController extends Controller
{



    public function guest_menu_checkIn(){
        $return = null;
        if (auth()->user()->isAdmin() == 2){
            $guests_Today_Check_In =DB::select("select * from guests where created_At = curdate() AND status = 1");
            $guestsToCheckIn = DB::select('select * from guests where status = 1');
            $cardsAvailable   = DB::select('select * from guest_cards where status = 1');
            $return = view('GuestView.checkinView', ['guestsToCheckIn'=> $guestsToCheckIn, 'cardsAvailable' => $cardsAvailable,  "guests_Today_Check_In"=>$guests_Today_Check_In]);
        }else{
            $return = redirect('/registerGuest');
        }
        return $return;
    }

    public function guest_menu_checkOut(){
        $return = null;
        if (auth()->user()->isAdmin() == 2){
            $guests_Today_Check_Out =DB::select("Select guests.name, guestId, guest_cards.id, company from guest_cards inner join guests where guests.id = guest_cards.guestId and guests.created_at = curdate() AND guests.status = 2");
            $guestsToCheckOut = DB::select('Select guests.name, guestId, guest_cards.id from guest_cards inner join guests where guests.id = guest_cards.guestId');
            $return = view('GuestView.checkOutView', ['guestsToCheckOut'=>$guestsToCheckOut, "guests_Today_Check_Out" => $guests_Today_Check_Out ]);
        }else{
            $return = redirect('/registerGuest');
        }
        return $return;
    }





    public function guest_menu(){
        return view("GuestView.Menu");
    }

        // Vis eret enkelt objekt
        public function showForm()
    {
        return view('AdminView.create');
    }

    public function guestPage(){
            $return = null;
        if (auth()->user()->isAdmin() == 2){
        $guests_Today_Check_In =DB::select("select * from guests where created_At = curdate() AND status = 1");
        $guests_Today_Check_Out =DB::select("Select guests.name, guestId, guest_cards.id from guest_cards inner join guests where guests.id = guest_cards.guestId and guests.created_at = curdate() AND guests.status = 2");
        $guestsToCheckOut = DB::select('Select guests.name, guestId, guest_cards.id from guest_cards inner join guests where guests.id = guest_cards.guestId');
        $guestsToCheckIn = DB::select('select * from guests where status = 1');
        $cardsAvailable   = DB::select('select * from guest_cards where status = 1');
        $return = view('AdminView.registrate', ['guestsToCheckIn'=> $guestsToCheckIn, 'cardsAvailable' => $cardsAvailable, 'guestsToCheckOut'=>$guestsToCheckOut, "guests_Today_Check_In"=>$guests_Today_Check_In, "guests_Today_Check_Out" => $guests_Today_Check_Out]);
        }else{
            $return = redirect('/registerGuest');
        }
        return $return;
    }

    public function ajaxGuestPage(){
        $guests_Today_Check_In =DB::select("select * from guests where created_At = curdate() AND status = 1");
        $guests_Today_Check_Out =DB::select("Select guests.name, guestId, guest_cards.id from guest_cards inner join guests where guests.id = guest_cards.guestId and created_At = curdate() AND guests.status = 2");
        $guestsToCheckOut = DB::select('Select guests.name, guestId, guest_cards.id from guest_cards inner join guests where guests.id = guest_cards.guestId');
        $guestsToCheckIn = DB::select('select * from guests where status = 1');
        $cardsAvailable   = DB::select('select * from guest_cards where status = 1');
        return response()->json(["guests_Today_Check_In" => $guests_Today_Check_In]);
    }

    public function rebookPage(){
        $earlierGuests = DB::select('select * from guests where status = 3');
        return view('AdminView.rebook', ['earlierGuests'=> $earlierGuests]);
    }



    // viser et view som skaber et objekt
    public function create()
    {
        return view('guests.create');
    }

    public function delete(Guest $guest){
        $guest->delete();
        return redirect('/guests');
    }


    //Denne vil gemme et objekt
    public function store(){
                $return = null;
            request()->validate(['name'=> 'required|regex:/^[\pL\s\-]+$/u', 'time'=>'required', 'company'=>'required', 'created_at'=> 'required'  ]);
        $user_id = auth()->user()->id;
        $user_name = auth()->user()->name;
        $guest = new Guest();
        $guest->name = request('name');
        $guest->created_at = request('created_at');
        $guest->updated_at = null;
        $guest->departed_at = null;
        $guest->company = request('company');
        $guest->time_created = request('time');
        $guest->amgros_employee = $user_name;
        $guest->status = 1;
        $guest->save();
        $user_id = auth()->user()->id;
        $appointment = new Appointment();
        $appointment->guestId = $guest->id;
        $appointment->userId = $user_id;
        $appointment->save();
        session()->flash('notif', 'Gæsten er hermed registreret');
        return redirect("registerGuest");
    }

    public function rebookGuest(){
        request()->validate(['name'=> 'required|regex:/^[\pL\s\-]+$/u', 'time'=>'required', 'company'=>'required', 'created_at'=> 'required'  ]);
        $guest = new Guest();
        $guest->id = request("idOfGuest");
        $guest->name = request("name");
        $guest->company = request("company");
        $user_id = auth()->user()->id;
        $appointment = new Appointment();
        $appointment->guestId = $guest->id;
        $appointment->userId = $user_id;
        $appointment->save();
            $date =(integer)preg_replace('/-+/', '', request('created_at'));
            $time = $this->findTime(strval($guest->time_created = request('time')));
            DB::update("UPDATE guests SET status = 1, created_at = $date, time_created = $time, updated_at = null, departed_at = null, time_departed =null, time_updated =null where guests.id = $guest->id");
        return redirect("rebook");
    }

    public function ajaxRequestPut(Guest $guest, GuestCard $guestCard){
        DB::update("UPDATE guests SET updated_at = now(), status = 2 where guests.id = $guest->id");
        DB::update("UPDATE guest_cards SET status = 2, guestId = $guest->id where id = $guestCard->id");
    }

    public function edit( Guest $guest, GuestCard $guestCard)
    {
        if ( $guest->status == 3){
          $date =(integer)preg_replace('/-+/', '', request('created_at'));
          $time = $this->findTime(strval($guest->time_created = request('time')));
            DB::update("UPDATE guests SET status = 1, created_at = $date, time = $time where guests.id = $guest->id");
            $i = 3;
        }
        else if ($guest->status == 2){
            DB::update("UPDATE guests SET time_updated = null, time_created = null, departed_at = now(), time_departed = CURRENT_TIME, status = 3 where guests.id = $guest->id");
            DB::update("UPDATE guest_cards SET status = 1, guestId = null where id = $guestCard->id");
            $i = 2;
        }
        else if ($guest->status == 1){
            DB::update("UPDATE guests SET updated_at = now(), time_updated =CURRENT_TIME ,status = 2 where guests.id = $guest->id");
            DB::update("UPDATE guest_cards SET status = 2, guestId = $guest->id where id = $guestCard->id");
        }
    }



    public function createUnexpectedGuests(){
        $guest = new Guest();
        $guest->name = request('name');
        $guest->status = 2;
        $guest->save();
        $user_id = auth()->user()->id;
        $appointment = new Appointment();
        $appointment->guestId = $guest->id;
        $appointment->userId = $user_id;
        $appointment->save();
    }

    protected function validateGuest()
    {
        return request()->validate([
            'name' => 'required',
            'cardNumber' => 'required',
        ]);
    }

    public function destroy()
    {

    }
    public function findTime($stringTime){
        $strippedSemicolonStr = preg_replace('/:+/', '', $stringTime."00");
        $integerTime = (integer)$strippedSemicolonStr;
        return $integerTime;
    }

    public function ajaxRequestPost(Request $request, $name)
    {
        $guest = new Guest();
        $guest->name = $name;
        $guest->company = request("company");
        $guest->created_at = today();
        $guest->status =1;
        $guest->save();
        $user_id = auth()->user()->id;
        $appointment = new Appointment();
        $appointment->guestId = $guest->id;
        $appointment->userId = $user_id;
        $appointment->save();
        return $guest->id;
    }

    public function ajaxRequest()

    {
        return view('AdminView.ajaxTest');

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

public function fill_check_in_advance_table(){

        $data = DB::select("select * from guests where created_At = curdate() AND status = 1");
        $guests_Today_Check_In = $this->correctDateFormat($data);

        $data = DB::select("Select guests.name, guestId, guest_cards.id, guests.updated_at, guests.time_updated, guests.created_at, guests.departed_at   from guest_cards inner join guests where guests.id = guest_cards.guestId and created_at = curdate() AND guests.status = 2");
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
        return $guestsCheckedOut;
    }


    public function regret_check_in( Guest $guest, GuestCard $guestCard)
    {
        $i = null;
        DB::update("UPDATE guests set updated_at = null , status = 1 where guests.id = $guest->id");
        DB::update("UPDATE guest_cards SET status = 1, guestId = null where id = $guestCard->id");
    }


    public function guest_check_in($id, $card )
    {
        DB::update("UPDATE guests SET updated_at = now(), time_updated =CURRENT_TIME, status = 2 where guests.id = $id");
        DB::update("UPDATE guest_cards SET status = 2, guestId = $id where id = $card");
        session()->flash('success', 'Registreringen er udført. Du ønskes en god dag');
        return redirect("guestMenu/checkIn");
    }

    public function guest_check_Out($id, $card )
    {

        DB::update("UPDATE guests SET time_updated = null, time_created = null, departed_at = now(), time_departed = CURRENT_TIME, status = 3 where guests.id = $id");
        DB::update("UPDATE guest_cards SET status = 1, guestId = null where id = $card");
        session()->flash('success', 'Udregistreringen er udført. Tak for besøget og på gensyn!');
        return redirect("guestMenu/checkOut");
    }

    public function update_page(){
        $guests = DB::select('select * from guests');
        $guests = DB::select('select * from guests');

        return view('AdminView.updateGuest',['guests'=> $guests ]);
    }

    public function update_guest_info($id, $name, $company){
        DB::update("UPDATE guests set name ='$name', company = '$company'  where id = $id");
        return redirect('/updateUsers');
    }


    public function fast_create(){
        $card = request("cardPicked");
        $guest = new Guest();
        $guest->name = request("guestName");
        $guest->company = request("company");
        $guest->created_at = today();
        $guest->updated_at = today();
        $guest->time_created = now();
        $guest->time_updated = now();
        $guest->status =2;
        $guest->save();

        $user_id = auth()->user()->id;
        $appointment = new Appointment();
        $appointment->guestId = $guest->id;
        $appointment->userId = $user_id;
        $appointment->save();

        $cardandUser = [];
        $cardandUser[0] = $guest->id;
        $cardandUser[1] = $card;
        return \response($cardandUser);

    }

    public function fast_update($cardId, $guestId){
        DB::update("UPDATE guest_cards SET status = 2, guestId = $guestId where id = $cardId");
}





}



