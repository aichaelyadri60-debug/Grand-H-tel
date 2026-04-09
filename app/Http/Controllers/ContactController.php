<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index(){
        return view('Home.Contact');
    }

    public function sendmail(Request $request){
        // dd('route ok');
        $request->validate([
            'name'   =>'required|string|max:50',
            'email'  =>'required|email',
            'phone'  =>'required|string|max:20',
            'subject'=>'required|string',
            'message'=>'required|string|min:5'
        ]);
        // dd($request->all());
        Mail::to('aichaelyadri60@gmail.com')
        ->send(new ContactMail($request->name ,$request->email ,$request->phone ,$request->subject,$request->message  ));
        return back()->with('success' ,'email envoyee avec success');
    }

}
