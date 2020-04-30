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

Route::get('/', function () {
    return view('auth.login');
});




Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');


/** hvis du er logget gør views tilgængelige */
Route::group(['middleware' => ['auth']], function() {
//HTTP GET
    Route::get('/', function () {
        return view('welcome');
    });
        Route::get('logout',  'AdminController@logout')->name('logout');
        Route::get('/createEmployeeView', 'AdminController@create_view');
        Route::get('/guests/create', 'GuestController@create');
        Route::get('/updateUsers', 'AdminController@update_page');
        Route::get('/registerGuest', 'GuestController@showForm');
        Route::get('/guests', 'GuestController@index');
        Route::get('/updateProfile', 'EmployeeController@show_profile');
        Route::post('/createEmployee/{type}', 'AdminController@create_employee');
        Route::post('/guests', 'GuestController@store');
        Route::post('guests/unregisteredCheckIn', 'GuestController@createUnexpectedGuests');
        Route::post('/ajaxRequest', 'GuestController@ajaxRequestPost');

    Route::put('/updateInfo/users', 'AdminController@update_user_info');

    Route::put('/updateInfo/admin', 'AdminController@update_admin_info');
    Route::put('/updateInfo/employee', 'EmployeeController@update_employee_info');
    Route::put('/guests/update/{id}/{name}/{company}', 'GuestController@update_guest_info');
    Route::put('/guests/{guest}/{guestCard}/edit', 'GuestController@edit');
    Route::put('/guests/rebook', 'GuestController@rebook');
    Route::put('/guests/{guest}/{guestCard}/regret', 'GuestController@regret_check_in');
    Route::put('/guests/edit', 'GuestController@multiple_check_in');

    Route::delete('/delete/{guest}', 'GuestController@delete');
    Route::delete('/updateInfo/users/delete', 'AdminController@delete_employee');
    Route::delete('/updateInfo/users/delete/guest', 'AdminController@delete_guest');

    Route::get('/guestsRegistration', 'GuestController@guestPage');

    Route::get('/ajaxGuestPage/guestsRegistration', 'GuestController@ajaxGuestPage');
    Route::get('/ajaxRequest/guests', 'GuestController@fill_check_in_advance_table');

    Route::get('/articles', 'ArticlesController@index');
    Route::get('/articles/create', 'ArticlesController@create');
    Route::get('/articles/{article}', 'ArticlesController@show');
    Route::get('/articles/{article}/edit', 'ArticlesController@edit');
    Route::get('/posts/{post}','PostsController@create');

//POST
    Route::post('/articles', 'GuestController@store');

    Route::get('/ajaxRequest', 'GuestController@ajaxRequest');
    Route::post('/ajaxRequest/{name}', 'GuestController@ajaxRequestPost');
    Route::put('/ajaxRequest/{guest}/{guestCard}/edit', 'GuestController@ajaxRequestPut');

});

// POST, GET, PUT, DELETE
