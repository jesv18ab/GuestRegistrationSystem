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
use function Sodium\add;

class GuestController extends Controller
{
    public function index()
    {
        $guestsExpected = DB::select('select * from guests where status = 1');
        $guestsCheckedIn = DB::select('select * from guests where status = 2');
        $guestsCheckedOut = DB::select('select * from guests where status = 3');

        return view('guestRegistration.index', ['guests' => $guestsExpected, 'guestsCheckedIn' => $guestsCheckedIn, 'guestsCheckedOut' => $guestsCheckedOut ] );
    }


        // Vis eret enkelt objekt
        public function showForm()
    {
        $earlierGuests = DB::select('select * from guests where status = 3');
        return view('guestRegistration.create',['earlierGuests'=> $earlierGuests ]);
    }
    public function guestPage(){

        $guestsToCheckOut = DB::select('Select guests.name, guestId, guest_cards.id from guest_cards inner join guests where guests.id = guest_cards.guestId');
        $guestsToCheckIn = DB::select('select * from guests where status = 1');
        $cardsAvailable   = DB::select('select * from guest_cards where status = 1');

        return view('guestRegistration.registrate', ['guestsToCheckIn'=> $guestsToCheckIn, 'cardsAvailable' => $cardsAvailable, 'guestsToCheckOut'=>$guestsToCheckOut]);
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

        //update guest
        if ( $guest->status == 3){
          $date =(integer)preg_replace('/-+/', '', request('expected_at'));
          $time = $this->findTime(strval($guest->time = request('time')));
            DB::update("UPDATE guests SET status = 1, expected_at = $date, time = $time where guests.id = $guest->id");
        }
        else if ($guest->status == 2){
            DB::update("UPDATE guests SET time = null, created_at = now(), status = 3 where guests.id = $guest->id");
            DB::update("UPDATE guest_cards SET status = 1, guestId = null where id = $guestCard->id");
        }
        else if ($guest->status == 1){
            DB::update("UPDATE guests SET updated_at = now(), status = 2 where guests.id = $guest->id");
            DB::update("UPDATE guest_cards SET status = 2, guestId = $guest->id where id = $guestCard->id");            }
        return redirect('/guestsRegistration');
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


    public function switchTables(){

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


}



