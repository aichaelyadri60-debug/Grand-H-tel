<?php

namespace App\Http\Controllers;

use App\Http\Requests\sendmailRequest;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index(){
        return view('Home.Contact');
    }

    public function sendmail(sendmailRequest $request){
        // dd('route ok');
        Mail::to('aichaelyadri60@gmail.com')
        ->send(new ContactMail($request->name ,$request->email ,$request->phone ,$request->subject,$request->message  ));
        return back()->with('success' ,'email envoyee avec success');
    }

}
