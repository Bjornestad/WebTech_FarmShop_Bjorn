<?php

use App\Http\Controllers\BuyController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogOutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\User;

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

/*
Route::get('/', function () {
    return view('home');
});
*/

Route::get('/', function () {
    return view('home');
})->name("home");


Route::get('/buy', [BuyController::class,'getBuyPage'])->name("buy");


/*Route::get('/userpage', function () {
    return view('userpage');
})->name("userpage");
*/

Route::get('/userpage', [UserController::class,'userOrderHistory'])->name("userpage");

Route::get('/loginPage', function () {
    return view('login');
})->name("loginPage");

Route::get('/logOut',[LogOutController::class,'logout'] )->name("logOut");

Route::post('/login',[LoginController::class,'authenticate'] )->name("login");

Route::get('/registerPage', function (){
    return view('register');
})->name("registerPage");

Route::post('RegisterController/register',[RegisterController::class,'register'] )->name('register');


Route::get('/basket', function () {
    return view('basket');
})->name("basket");


Route::get('/welcome', function () {
    return view('welcome');
})->name("welcome");
