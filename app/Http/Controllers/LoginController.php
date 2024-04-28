<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LoginController extends Controller
{

    public function index(){
        return view('login.index');
    }
    public function store(Request $request){
        $cleanData = $request->validate([
            "loginId" => ["required", Rule::exists("users", "email")],
            "password" => ["required"]
        ],[
            'loginId.exists' => 'Your Login ID does not exist'
        ]);

        $credentials = [
            'email' => $cleanData['loginId'],
            'password' => $cleanData['password']
        ];


        if(auth()->attempt($credentials)){
            return redirect("/")->with("message", "Welcome" . "" . auth()->user()->name ."");
        }else{
            return back()->withErrors(["password" => "Your password is incorrect"]);
        }
    }
}
