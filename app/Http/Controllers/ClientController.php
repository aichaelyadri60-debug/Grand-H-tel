<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();
        if($request->search){
            $query->where('name' ,'like' ,'%'.$request->search.'%' )
                     ->orWhere('email' ,'like' ,'%'.$request->search.'%');
        }

        if($request->status){
            $query->where('status' ,$request->status);
        }

        $clients =$query->where('role' ,'client')->paginate(6);
        return view('receptionist.clients' ,compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function banordeban(Client $client)
    {

    }
}
