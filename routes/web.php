<?php

use App\Http\Controllers\FavouriteFruit;
use App\Http\Controllers\FruitController;
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

Route::get('/',[FruitController::class,'index'])->middleware('guest');
Route::post('/addToFavourites',[FavouriteFruit::class,'checkGuest']);