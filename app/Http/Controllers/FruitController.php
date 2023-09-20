<?php

namespace App\Http\Controllers;

use App\Models\Fruit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


class FruitController extends Controller
{
    //
    public function index(Request $request){
        $search=$request->input('search');
        $selectedFamilyNames = $request->input('family_names', []);
        $query=Fruit::query();
        $distinctFamilyNames = Fruit::distinct()->pluck('family');
        if($search){
            $query->where('name', 'like', '%' . $search . '%');
        }
        if (!empty($selectedFamilyNames)) {
            $query->whereIn('family', $selectedFamilyNames);
        }
        $fruits=$query->paginate(10);
        $currentRoute = Route::current()->getName();
        if($currentRoute==='userFruit'){
            return view('userFruit',compact('fruits','search','distinctFamilyNames','selectedFamilyNames'));
        }
        return view('fruit',compact('fruits','search','distinctFamilyNames','selectedFamilyNames'));
       
    }
}
