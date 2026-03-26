<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth ;

class AuthController extends Controller
{

    public function Showlogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required|in:admin,receptionniste'
        ]);


        if (Auth::attempt($request->only('email', 'password', 'role'))) {
            $request->session()->regenerate();
            return redirect()->route('receptionnist.dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials'
        ]);
    }
}
