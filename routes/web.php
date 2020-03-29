<?php

/*
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});
/*
 *
Route::get('/', function () {
    return view('auth.login');
});


*/
/*
Route::get('/', function () {
    return view('welcome');
});
*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/test', function (){
    return view('test', ['name' => request('name')]);
} );

/** hvis du er logget gør views tilgængelige */
Route::group(['middleware' => ['auth']], function() {

});
//HTTP GET
Route::get('/guests/create', 'GuestController@create');
Route::get('/registerGuest', 'GuestController@showForm');
Route::get('/guests', 'GuestController@index');
Route::post('/guests', 'GuestController@store');
Route::put('/guests/{guest}/{guestCard}/edit', 'GuestController@edit');
Route::delete('/delete/{guest}', 'GuestController@delete');
Route::get('/guestsRegistration', 'GuestController@guestPage');

Route::get('/articles', 'ArticlesController@index');
Route::get('/articles/create', 'ArticlesController@create');
Route::get('/articles/{article}', 'ArticlesController@show');
Route::get('/articles/{article}/edit', 'ArticlesController@edit');
Route::get('/posts/{post}','PostsController@create');

//POST
Route::post('/articles', 'GuestController@store');




// POST, GET, PUT, DELETE
