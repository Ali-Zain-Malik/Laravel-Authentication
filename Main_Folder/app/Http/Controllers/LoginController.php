<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
                return redirect()->route("user.dashboard");
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


    public function register()
    {
        return view("register");
    }


    public function registerProcess(Request $request)
    {
        $validator  =   Validator::make($request->all(),
        [
            "email"     =>  "required|email|unique:users",
            "password"  =>  "required",
            "name"      =>  "required"
        ]);

        if($validator->passes())
        {
           $user            =   new User();
           $user->name      =   $request->name;
           $user->email     =   $request->email;
           $user->password  =   Hash::make($request->password);
           $user->role      =   "user";
           $user->save();

           return redirect()->route("user.login")->with("success", "Account created successfully");
        }
        else
        {
            return redirect()->route("user.register")->withInput()->withErrors($validator);
        }

    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route("user.login");
    }

}
