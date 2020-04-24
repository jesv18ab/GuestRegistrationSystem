<?php

namespace App\Http\Controllers;

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

class GuestController extends Controller
{
    public function index()
    {
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

        return view('guestRegistration.index', ['guests' => $guestsExpected, 'guestsCheckedIn' => $guestsCheckedIn, 'guestsCheckedOut' => $guestsCheckedOut, "guests_Today_Check_In"=>$guests_Today_Check_In, "guests_Today_arrived" => $guests_Today_arrived, "guests_Today_Checked_Out"=>$guests_Today_Checked_Out, "cardsAvailable"=> $cardsAvailable  ] );
    }

public function multiple_check_in(Request $request){

   $cards = $request->get('arr2');
     $persons = $request->get('arr');
     $number_of_cards =count($persons);
     dd($request);
        for ($i = 0; $i< $number_of_cards; $i++){
            $id = $persons[$i];
            $card = $cards[$i];
            DB::update("UPDATE guest_cards SET status = 2, guestId = $id where id =$card ");
            DB::update("UPDATE guests SET updated_at = now(), time_updated = CURRENT_TIME, status = 2 where guests.id = $id");
        }
return \response("Hej hej");

}
        // Vis eret enkelt objekt
        public function showForm()
    {
        $earlierGuests = DB::select('select * from guests where status = 3');
        return view('guestRegistration.create',['earlierGuests'=> $earlierGuests ]);
    }
    public function guestPage(){
        $guests_Today_Check_In =DB::select("select * from guests where created_At = curdate() AND status = 1");
        $guests_Today_Check_Out =DB::select("Select guests.name, guestId, guest_cards.id from guest_cards inner join guests where guests.id = guest_cards.guestId and guests.created_at = curdate() AND guests.status = 2");
        $guestsToCheckOut = DB::select('Select guests.name, guestId, guest_cards.id from guest_cards inner join guests where guests.id = guest_cards.guestId');
        $guestsToCheckIn = DB::select('select * from guests where status = 1');
        $cardsAvailable   = DB::select('select * from guest_cards where status = 1');

        return view('guestRegistration.registrate', ['guestsToCheckIn'=> $guestsToCheckIn, 'cardsAvailable' => $cardsAvailable, 'guestsToCheckOut'=>$guestsToCheckOut, "guests_Today_Check_In"=>$guests_Today_Check_In, "guests_Today_Check_Out" => $guests_Today_Check_Out]);
    }

    public function ajaxGuestPage(){
        $guests_Today_Check_In =DB::select("select * from guests where created_At = curdate() AND status = 1");
        $guests_Today_Check_Out =DB::select("Select guests.name, guestId, guest_cards.id from guest_cards inner join guests where guests.id = guest_cards.guestId and created_At = curdate() AND guests.status = 2");
        $guestsToCheckOut = DB::select('Select guests.name, guestId, guest_cards.id from guest_cards inner join guests where guests.id = guest_cards.guestId');
        $guestsToCheckIn = DB::select('select * from guests where status = 1');
        $cardsAvailable   = DB::select('select * from guest_cards where status = 1');
        return response()->json(["guests_Today_Check_In" => $guests_Today_Check_In]);
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
        $guest = new Guest();
        $guest->name = request('name');
        $guest->created_at = date(request('created_at'));
        $guest->updated_at = null;
        $guest->departed_at = null;
        $guest->time_created = request('time');
        $guest->status = 1;
        $guest->save();
        return view('welcome');
        //Man skal vise en from for at kunne justere en eksisterende resource
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
            DB::update("UPDATE guests SET updated_at = now(), time_arrived =CURRENT_TIME ,status = 2 where guests.id = $guest->id");
            DB::update("UPDATE guest_cards SET status = 2, guestId = $guest->id where id = $guestCard->id");
        }
    }



    public function createUnexpectedGuests(){
        $guest = new Guest();
        $guest->name = request('name');
        $guest->status = 2;
        $guest->save();
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
        $guest->created_at = today();
        $guest->status =1;
        $guest->save();
        return $guest->id;
    }

    public function ajaxRequest()

    {
        return view('guestRegistration.ajaxTest');

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



    public function update_page(){
        $guests = DB::select('select * from guests');
        $guests = DB::select('select * from guests');

        return view('guestRegistration.updateGuest',['guests'=> $guests ]);
    }

    public function update_guest_info($id, $name, $company){
        DB::update("UPDATE guests set name ='$name', company = '$company'  where id = $id");
        return redirect('/updateGuestInfo');
    }



}



