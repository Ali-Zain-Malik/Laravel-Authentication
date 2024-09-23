<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    // This method will show the login page.
    public function index()
    {
        return view("login");
    }

    // This method will authenticate User
    public function authenticate(Request $request)
    {
        $validator  =   Validator::make($request->all(),
        [
            "email"     =>  "required|email",
            "password"  =>  "required"
        ]);


        if($validator->passes())
        {
            if(Auth::attempt(["email" => $request->email, "password" => $request->password]))
            {
                
            }   
            else
            {
                return redirect()->route("user.login")->with("error", "Either email or password is incorrect");
            }
        }
        else
        {
            return redirect()->route("user.login")->withInput()->withErrors($validator);
        }
    }
}
