<?php

namespace App\Http\Controllers;


use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\loginRequest;

class AuthController extends Controller
{

    public function Showlogin()
    {
        return view('auth.login');
    }

    public function ShowRegister()
    {
        return view('auth.register');
    }

    public function login(loginRequest $request)
    {

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect('/');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials'
        ]);
    }


    public function Register(RegisterRequest  $request)
    {
        User::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'password'   => Hash::make($request->password)
        ]);
        return redirect()->route('Showlogin')->with('success', 'vous avez enregistrer avec success .');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/');
    }
}
