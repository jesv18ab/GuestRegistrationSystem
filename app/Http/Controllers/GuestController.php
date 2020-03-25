<?php

namespace App\Http\Controllers;

use App\Guest;
use Illuminate\Http\Request;
use App\Article;
use App\Tag;
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
        $guestsAll = Guest::latest()->get();
       // $guestsCheckedIn = DB::select('select * from')
      //  View::make('guestRegistration.index', compact(['guestsExpected' => $guestsExpected, 'guestsCheckedIn'=> $guestsCheckedIn, 'guestsCheckedOut'=> $guestsCheckedOut]));
        return view('guestRegistration.index', ['guests' => $guestsExpected, 'guestsCheckedIn' => $guestsCheckedIn, 'guestsCheckedOut' => $guestsCheckedOut ] );
    }


        // Vis eret enkelt objekt
        public function showForm()
    {
        return view('guestRegistration.create');
    }
    public function guestPage(){

        $guestsToCheckOut = DB::select('select * from guests where status = 2');
        $guestsToCheckIn = DB::select('select * from guests where status = 1');
        return view('guestRegistration.registrate', ['guestsToCheckIn'=> $guestsToCheckIn, 'guestsToCheckOut'=> $guestsToCheckOut ]);
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

    public function edit( Guest $guest)
    {
        $i = $guest->status + 1;
        DB::update("UPDATE guests SET status = $i where guests.id = $guest->id");
        return redirect('/guestsRegistration');
    }

    public function update(Article $article)
    {
        $article->update($this->validateGuest());

        return redirect('/articles/' . $article->id);
        //Man skal vise en from for at kunne justere en eksisterende resource
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

}



