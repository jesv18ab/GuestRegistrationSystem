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
        $data = DB::select("select * from guests where expected_At = curdate() AND status = 1");
        $guests_Today_Check_In = $this->correctDateFormat($data);

        $data = DB::select("Select guests.name, guestId, guest_cards.id, guests.updated_at, guests.time, guests.expected_at, guests.created_at   from guest_cards inner join guests where guests.id = guest_cards.guestId and expected_At = curdate() AND guests.status = 2");
        $guests_Today_arrived = $this->correctDateFormat($data);

        $data=DB::select('select * from guests where status = 1');$this->correctDateFormat($data);
        $guestsExpected = $this->correctDateFormat($data);

        $data = DB::select('select * from guests where status = 2');
        $guestsCheckedIn = $this->correctDateFormat($data);

        $data =  DB::select('select * from guests where status = 3 and created_at = curdate()');
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
        for ($i = 0; $i< $number_of_cards; $i++){
            $id = $persons[$i];
            $card = $cards[$i];
            DB::update("UPDATE guest_cards SET status = 2, guestId = $id where id =$card ");
            DB::update("UPDATE guests SET updated_at = now(), status = 2 where guests.id = $id");
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
        $guests_Today_Check_In =DB::select("select * from guests where expected_At = curdate() AND status = 1");
        $guests_Today_Check_Out =DB::select("Select guests.name, guestId, guest_cards.id from guest_cards inner join guests where guests.id = guest_cards.guestId and expected_At = curdate() AND guests.status = 2");
        $guestsToCheckOut = DB::select('Select guests.name, guestId, guest_cards.id from guest_cards inner join guests where guests.id = guest_cards.guestId');
        $guestsToCheckIn = DB::select('select * from guests where status = 1');
        $cardsAvailable   = DB::select('select * from guest_cards where status = 1');

        return view('guestRegistration.registrate', ['guestsToCheckIn'=> $guestsToCheckIn, 'cardsAvailable' => $cardsAvailable, 'guestsToCheckOut'=>$guestsToCheckOut, "guests_Today_Check_In"=>$guests_Today_Check_In, "guests_Today_Check_Out" => $guests_Today_Check_Out]);
    }

    public function ajaxGuestPage(){
        $guests_Today_Check_In =DB::select("select * from guests where expected_At = curdate() AND status = 1");
        $guests_Today_Check_Out =DB::select("Select guests.name, guestId, guest_cards.id from guest_cards inner join guests where guests.id = guest_cards.guestId and expected_At = curdate() AND guests.status = 2");
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
        $guest->expected_at = date(request('expected_at'));
        $guest->time = request('time');
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
   /*     $i = null;
        //update guest
        if ( $guest->status == 3){
          $date =(integer)preg_replace('/-+/', '', request('expected_at'));
          $time = $this->findTime(strval($guest->time = request('time')));
            DB::update("UPDATE guests SET status = 1, expected_at = $date, time = $time where guests.id = $guest->id");
            $i = 3;
        }
        else if ($guest->status == 2){
            DB::update("UPDATE guests SET time = null, created_at = now(), status = 3 where guests.id = $guest->id");
            DB::update("UPDATE guest_cards SET status = 1, guestId = null where id = $guestCard->id");
            $i = 2;
        }
        else if ($guest->status == 1){
            DB::update("UPDATE guests SET updated_at = now(), status = 2 where guests.id = $guest->id");
            DB::update("UPDATE guest_cards SET status = 2, guestId = $guest->id where id = $guestCard->id");
        }*/
    }

    public function update(Article $article)
    {
        $article->update($this->validateGuest());
        return redirect('/articles/' . $article->id);
        //Man skal vise en from for at kunne justere en eksisterende resource
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
        $guest->expected_at = today();
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
            $toFormat->expected_at = date_create($toFormat->expected_at)->format('d-m-y');
            $toFormat->updated_at = date_create($toFormat->updated_at)->format('d-m-y');
            $toFormat->created_at = date_create($toFormat->created_at)->format('d-m-y');
            array_push($formatted, $toFormat);
        }
     return $formatted;
 }

public function fill_check_in_advance_table(){

        $data = DB::select("select * from guests where expected_At = curdate() AND status = 1");
        $guests_Today_Check_In = $this->correctDateFormat($data);

        $data = DB::select("Select guests.name, guestId, guest_cards.id, guests.updated_at, guests.time, guests.expected_at, guests.created_at   from guest_cards inner join guests where guests.id = guest_cards.guestId and expected_At = curdate() AND guests.status = 2");
        $guests_Today_arrived = $this->correctDateFormat($data);

        $data=DB::select('select * from guests where status = 1');$this->correctDateFormat($data);
        $guestsExpected = $this->correctDateFormat($data);

        $data = DB::select('select * from guests where status = 2');
        $guestsCheckedIn = $this->correctDateFormat($data);

        $data =  DB::select('select * from guests where status = 3 and created_at = curdate()');
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







}



