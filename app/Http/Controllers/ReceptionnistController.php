<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use GuzzleHttp\Psr7\Query;

class ReceptionnistController extends Controller
{
    public function index()
    {
        return view('receptionist.dashboard');
    }

    public function dashboard(Request $request)
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

        return view('receptionist.room', compact('rooms'));
    }
}
