<?php

namespace App\Http\Controllers;

use App\Models\FavouriteFruit;
use Illuminate\Http\Request;


class FruitFavorite extends Controller
{
    //
    public function checkGuest(){
        if(!auth()->user()){
            return back()->with('error', 'Please log in to add to favorites.');
        }
    }
    public function addToFavourites(Request $request){
          $fruitId=$request->input('fruitId');
          $user=auth()->user();
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
