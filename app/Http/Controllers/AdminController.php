<?php

namespace App\Http\Controllers;

use App\Models\Fruit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class AdminController extends Controller
{
    //
    public function index(Request $request)
        {
            $search = $request->input('search');
            $selectedFamilyNames = $request->input('family_names', []);
            $query = Fruit::query();
            $distinctFamilyNames = Fruit::distinct()->pluck('family');
            if ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            }
            if (!empty($selectedFamilyNames)) {
                $query->whereIn('family', $selectedFamilyNames);
            }
            $query
            ->leftJoin('favourite_fruits', 'fruits.id', '=', 'favourite_fruits.fruit_id')
            ->select('fruits.*', DB::raw('COUNT(favourite_fruits.id) as favoriteCount'))
            ->groupBy('fruits.id');
            $fruits = $query->paginate(10);
            return view('admin', compact('fruits', 'search', 'distinctFamilyNames', 'selectedFamilyNames'));
        }
    
        
    
    
}
