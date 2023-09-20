<?php

use App\Http\Controllers\FavouriteFruit;
use App\Http\Controllers\FruitController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

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

Route::match(['get', 'post'],'/',[FruitController::class,'index'])->middleware('guest');
Route::post('/addToFavourites',[FavouriteFruit::class,'checkGuest'])->middleware('guest');
Route::get('/login',[LoginController::class,'index'])->middleware('guest');
Route::get('/login/create',[LoginController::class,'create'])->middleware('guest');
Route::post('/userRegister',[LoginController::class,'createUserRequest'])->middleware('guest');