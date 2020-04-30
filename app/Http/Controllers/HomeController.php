<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $return = null;
        if (auth()->user()->isAdmin() == 2){
            $return = view('welcome');
        }else{
            $return = redirect("registerGuest");
        }
        return $return;
    }


}
