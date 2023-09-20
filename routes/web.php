<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\FruitController;
use App\Http\Controllers\FruitFavorite;
use App\Http\Controllers\LoginController;
use App\Models\Fruit;
use GuzzleHttp\Middleware;
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
Route::post('/addToFavourites',[FruitFavorite::class,'checkGuest'])->middleware('guest');
Route::get('/login',[LoginController::class,'index'])->middleware('guest');
Route::get('/login/create',[LoginController::class,'create'])->middleware('guest');
Route::post('/userRegister',[LoginController::class,'createUserRequest'])->middleware('guest');
Route::post('/login',[LoginController::class,'loginRequest'])->middleware('guest');
Route::get('/userFruit',[FruitController::class,'index'])->middleware('auth')->middleware('user')->name('userFruit');
Route::post('/logout',[LoginController::class,'logoutRequest'])->middleware('auth')->middleware('user');
Route::post('/addToFavorites',[FruitFavorite::class,'addToFavourites'])->middleware('auth')->middleware('user');
Route::get('/favoriteShow',[FruitFavorite::class,'index'])->middleware('auth')->middleware('user');
Route::delete('/removeFromFavourites',[FruitFavorite::class,'removeFromFavourites'])->middleware('auth')->middleware('user');
Route::get('/admin',[AdminController::class,'index'])->middleware('admin');
Route::post('/Adminlogout',[LoginController::class,'logoutRequest'])->middleware('auth')->middleware('admin');