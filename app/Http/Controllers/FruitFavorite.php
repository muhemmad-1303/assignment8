<?php

namespace App\Http\Controllers;

use App\Models\FavouriteFruit;
use Illuminate\Http\Request;


class FruitFavorite extends Controller
{
    //
    public function index(){
        $user=auth()->user();
        $fruits = FavouriteFruit::join('fruits', 'favourite_fruits.fruit_id', '=', 'fruits.id')
        ->where('favourite_fruits.user_id', $user->id)
        ->select('fruits.name','fruits.calories','fruits.fat','fruits.sugar','fruits.carbohydrates','fruits.protein','fruits.id')
        ->get();
        return view('favoriteShow',compact('fruits'));
    }
    public function checkGuest(){
        if(!auth()->user()){
            return back()->with('error', 'Please log in to add to favorites.');
        }
    }
    public function addToFavourites(Request $request){
          $user=auth()->user();
          $favoriteCount=FavouriteFruit::where('user_id',$user->id)->count();
          if($favoriteCount>=10){
            return back()->with('error', 'You have reached the maximum limit of favorites 10');
          }
          $fruitId=$request->input('fruitId');
          $existFavorite=FavouriteFruit::where('user_id',$user->id)
          ->where('fruit_id',$fruitId)
          ->first();
          if(!$existFavorite){
            FavouriteFruit::create([
                'user_id' => $user->id,
                'fruit_id' => $fruitId,
            ]);
            return back();
          }
          else{

          }
          
    }
    public function removeFromFavourites(Request $request){
          $fruitId=$request->input('fruitId');
          $user=auth()->user();
          FavouriteFruit::where('user_id', $user->id)
          ->where('fruit_id', $fruitId)
          ->delete();
          return back();
    }
}
