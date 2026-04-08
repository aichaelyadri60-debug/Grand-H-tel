<?php

namespace App\Http\Controllers;

use App\Http\Requests\changePasswordRequest;
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

        $user = User::where('email', $request->email)->firstOrFail();
        if ($user->is_banned) {
            return back()->with('error', 'vous avez banni');
        }

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            if (!$user->changed_password) {
                return redirect()->route('password.change.form');
            }
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

    public function changePasswordForm()
    {
        return view('Dashboard.clients.change_password');
    }

    public function changePassword(changePasswordRequest $request)
    {
        $user = auth()->user();

        $user->update([
            'password' => Hash::make($request->password),
            'changed_password' => true,
        ]);

        return redirect('/')->with('success', 'Password updated successfully');
    }
}
