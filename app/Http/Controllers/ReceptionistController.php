<?php

namespace App\Http\Controllers;

use App\Http\Requests\receptionistRequest;
use App\Mail\PasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class ReceptionistController extends Controller
{
    // LIST
    public function index()
    {
        $receptionists = User::where('role', 'receptionniste')->latest()->paginate(5);

        return view('admin.receptionists.index', compact('receptionists'));
    }

    // FORM CREATE
    public function create()
    {
        return view('admin.receptionists.create');
    }

    // STORE
    public function store(receptionistRequest $request)
    {


        $passwordTemp = Str::random(8);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => 'Receptionniste',
            'password' => Hash::make($passwordTemp),
            'changed_password' => true
        ]);
        Mail::to($request->email)
            ->send(new PasswordMail($request->name, $request->email, $request->phone, $passwordTemp));

        return redirect()
            ->route('admin.receptionists.index')
            ->with('success', 'Receptionist created');
    }

    public function show(User $receptionist)
    {
        return view('admin.receptionists.show', compact('receptionist'));
    }
    // EDIT
    public function edit(User $receptionist)
    {
        return view('admin.receptionists.edit', compact('receptionist'));
    }

    // UPDATE
    public function update(Request $request, User $receptionist)
    {
        $request->validate([
            'name' => 'required',
            'email' => "required|email|unique:users,email,$receptionist->id",
            'phone' => 'required'
        ]);

        $receptionist->update($request->only('name', 'email', 'phone'));

        return back()->with('success', 'Updated successfully');
    }
    // DELETE
    public function destroy(User $receptionist)
    {
        $receptionist->delete();

        return back()->with('success', 'Deleted successfully');
    }
}
