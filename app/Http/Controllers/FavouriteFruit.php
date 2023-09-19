<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavouriteFruit extends Controller
{
    //
    public function checkGuest(){
        if(!auth()->user()){
            return back()->with('error', 'Please log in to add to favorites.');
        }
    }
}
