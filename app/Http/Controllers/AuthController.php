<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * ShowLogin.
     */
    public function ShowLogin(){
        return view('auth.login');
    }
    /**
     * ShowRegister.
     */
    public function ShowRegister()
    {
        return view('auth.register');
    }
    /**
     * Register.
     */
    public function Register(Request $request){
        $request->validate([
            'name'      =>'required|string|max:100',
            'email'     =>'required|email',
            'password'  =>'required|min:6|confirmed'
        ]);

        User::create([
            'name'        =>$request->name,
            'email'       =>$request->email,
            'password'    =>Hash::make($request->password)
        ]);

        return redirect()->route('login')->with('succes' ,'vous avez enregistee avec success');
    }


    /**
     *Login.
     */
    public function login(Request $request){
        $request->validate([
            'email' =>'required|email',
            'password' =>'required|min:6'
        ]);

        if(Auth::attempt($request->only('email' ,'password'))){
            return redirect('/');
        }
        return redirect()->back()->with(['email' =>'email ou password invalide.']);
    }

    /**
     * Logout.
     */
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalide();
        return redirect('/');
    }



}
