<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Session;

// try database table
Route::get('/practice', [UserController::class,'practice']);

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return view('homepage');
});


//registration
Route::get('/phone_number_verify', function () {
    return view('phone_number');
});
Route::post('/phone_number_verify', [UserController::class,'verify_phone']);

Route::get('/otp_verify', function () {
    if (Session::has('reg_phone')&&Session::has('reg_otp')) {
        return view('otp');
    } else {
        return redirect('/phone_number_verify');
    }
});
Route::post('/otp_verify', [UserController::class,'otp_verify']);

Route::get('/registration', function () {
    if (Session::has('reg_phone')) {
        return view('registration');
    } else {
        return redirect('/phone_number_verify');
    }
});
Route::post('/registration', [UserController::class,'registration']);

//login
Route::get('/phone_number_login', function () {
    return view('phone_login');
});
Route::post('/phone_number_login', [UserController::class,'phone_number_login']);

Route::get('/otp_login', function () {
    if (Session::has('login_phone')&&Session::has('login_otp')) {
        return view('otp_login');
    } else {
       return redirect('/phone_number_login');
    }
});
Route::post('/otp_login', [UserController::class,'otp_login']);

Route::get('/login', function () {
    return view('login');
});
Route::post('/login', [UserController::class,'login']);

//customer dasboard
Route::get('/customer_dashboard', [UserController::class,'customer_dashboard']);

Route::get('/customer_profile_update', function () {
    if (Session::has('phone') && Session::get('type') == "Customer") {
        return view('customer_profile_update');
    } else {
        return redirect('/login');
    }
});
Route::post('/customer_profile_update', [UserController::class,'customer_profile_update']);

Route::get('/customer_book_now', [UserController::class,'customer_book_now']);
Route::post('/customer_book_now', [UserController::class,'customer_book_now_post']);

//artist dasboard
Route::get('/artist_dashboard', [UserController::class,'artist_dashboard']);

Route::get('/artist_profile_update', function () {
    if (Session::has('phone') && Session::get('type') == "Henna Artist") {
        return view('artist_profile_update');
    } else {
        return redirect('/login');
    }
});
Route::post('/artist_profile_update', [UserController::class,'artist_profile_update']);

Route::get('/artist_appointment', [UserController::class,'artist_appointment']);
Route::post('/artist_appointment', [UserController::class,'artist_appointment_confirm']);

//logout
Route::get('/logout', [UserController::class,'logout']);

