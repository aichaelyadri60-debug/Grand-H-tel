<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\passwordProfile;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(passwordProfile $request)
    {
        $request->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('statusPassword', 'password-updated');
    }
}
