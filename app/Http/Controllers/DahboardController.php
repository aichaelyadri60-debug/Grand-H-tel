<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Query;

class DahboardController extends Controller
{
    public function index()
    {
        $totalClients = User::where('role', 'client')->count();

        $totalRooms = Room::count();

        $todayReservations = Reservation::whereDate(
            'created_at',
            Carbon::today()
        )->count();

        $pending = Reservation::where('status', 'pending')->count();
        $accepted = Reservation::where('status', 'confirmed')->count();
        $cancelled = Reservation::where('status', 'cancelled')->count();

        $latestReservations = Reservation::with('user','room')
            ->latest()
            ->take(5)
            ->get();

        return view('Dashboard.statistque', compact(
            'totalClients',
            'totalRooms',
            'todayReservations',
            'pending',
            'accepted',
            'cancelled',
            'latestReservations'
        ));
    }

    public function dashboard_room(Request $request)
    {
        $query = Room::query();

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('roomNumber', 'like', '%' . $request->search . '%')
                    ->orWhere('type', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->status && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        if ($request->type && $request->type !== 'all') {
            $query->where('type', $request->type);
        }

        $rooms = $query
            ->orderBy('created_at', 'desc')
            ->paginate(6)
            ->withQueryString();

        return view('Dashboard.room.room', compact('rooms'));
    }
}
