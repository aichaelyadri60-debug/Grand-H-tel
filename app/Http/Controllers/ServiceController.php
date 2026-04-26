<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = config('Hotel_services');
        return view('Home.service', compact('services'));
    }
}
