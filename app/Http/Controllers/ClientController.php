<?php

namespace App\Http\Controllers;

use App\Http\Requests\clientRequest;
use App\Mail\PasswordMail;
use App\Models\Invoice;
use App\Models\Reservation;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::where('role', 'client');
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->status === 'banned') {
            $query->where('is_banned', true);
        } else if ($request->status === 'debanned') {
            $query->where('is_banned', false);
        }

        $clients = $query->paginate(6);
        return view('Dashboard.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Dashboard.room.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(clientRequest $request)
    {
        $passwordTemp = Str::random(8);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($passwordTemp),
            'changed_password' => false,
        ]);

        Mail::to($request->email)
            ->send(new PasswordMail($request->name, $request->email, $request->phone, $passwordTemp));
        return back()->with(
            'success',
            'Client created. et email envoyer avec success. '
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(User $client)
    {
        return view('Dashboard.clients.show', compact('client'));
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
    public function banordeban(User $client)
    {
        $client->is_banned = !$client->is_banned;
        $client->save();
        return back()->with('success', 'client debanni avec success.');
    }


    public function dashboard()
    {
        $user = Auth::user();

        $reservations = $user->reservations()
            ->with(['payment.invoice'])
            ->latest()
            ->get();

        $totalReservations = $reservations->count();
        $paidReservations = $reservations->where('payment.status', 'paid')->count();
        $pendingReservations = $reservations->where('status', 'pending')->count();

        return view('client.dashboard', compact(
            'reservations',
            'totalReservations',
            'paidReservations',
            'pendingReservations'
        ));
    }




    public function reservations()
    {
        $user = Auth::user();

        $reservations = $user->reservations()
            ->with(['payment.invoice'])
            ->latest()
            ->paginate(5);

        return view('client.reservations', compact('reservations'));
    }


    


}
