<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    //
    public function index(){
        return view('login');
    }
    public function create()
    {
        return view('createUser');
    }
    public function createUserRequest(Request $request){
        $data = $request->validate([
            'username' => ['required', 'alpha_num', 'unique:users'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required'],
            'gender' => ['required'],
        ]);
        $data['password']=bcrypt($data["password"]);
        $user = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $data['password'],
            'gender' => $data['gender'],
        ]);   
        return redirect('/login'); 
    }

    public function loginRequest(Request $request)
    {
        $data = $request->validate(
            [
                'username' => 'required', 'alpha_num',
                'password' => 'required',
            ]
        );
        if (auth()->attempt($data)) {
            return redirect('/todo')->with('success', 'welcome');
        }
        throw ValidationException::withMessages([
            'username' => 'user name dosent exist',
        ]);
    }

}
