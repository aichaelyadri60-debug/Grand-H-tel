<?php

namespace App\Http\Controllers;

use App\Http\Requests\receReservationsRequest;
use App\Http\Requests\reservationrequest;
use App\Models\Payment;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{


    public function index(Request $request)
    {
        $query = Reservation::with('user');
        if ($request->status) {
            $query->where('status', $request->status);
        }
        if ($request->search) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }
        $reservations = $query
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        return view('Dashboard.reservations.reservations', compact('reservations'));
    }



    public function show(Reservation $reservation)
    {

        // dd($reservation->payment);
        if ($reservation->user_id !== auth()->id()) {
            abort(403);
        }

        $reservation->load(['room', 'payment.invoice']);

        return view('client.show', compact('reservation'));
    }


    public function formReserv(Room $room)
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('Showlogin');
        }
        $room = Room::findOrFail($room->id);
        return view('Dashboard.reservations.create', compact('room'));
    }




    public function reserver(reservationrequest $request, Room $room)
    {
        $reservation = Reservation::where('room_id', $room->id)
            ->whereIn('status', ['pending', 'confirmed', 'checked_in'])
            ->exists();

        if ($reservation) {
            return back()->with('error', 'on peut pas reserver cette chambre');
        }

        $checkIn = Carbon::parse($request->check_in);
        $checkOut = Carbon::parse($request->check_out);
        $alreadyConfirmed = Reservation::where('room_id', $room->id)
            ->where('status', 'confirmed')
            ->where(function ($query) use ($checkIn, $checkOut) {

                $query->whereBetween('check_in', [$checkIn, $checkOut])
                    ->orWhereBetween('check_out', [$checkIn, $checkOut])
                    ->orWhere(function ($q) use ($checkIn, $checkOut) {
                        $q->where('check_in', '<=', $checkIn)
                            ->where('check_out', '>=', $checkOut);
                    });
            })
            ->exists();

        if ($alreadyConfirmed) {
            return back()->with(
                'error',
                'Cette chambre est déjà réservée pour ces dates.'
            );
        }


        $nights = $checkIn->diffInDays($checkOut);
        $totalPrice = $nights * $room->price;

        Reservation::create([
            'user_id' => auth()->id(),
            'room_id' => $room->id,
            'check_in' => $checkIn,
            'check_out' => $checkOut,
            'guests' => $request->guests,
            'total_price' => $totalPrice,
            'status' => 'pending',
            'payment_status' => 'unpaid',
        ]);

        return redirect()
            ->back()
            ->with('success', 'Reservation created successfully!');
    }




    public function refuse(Reservation $reservation)
    {
        $reservation->update([
            'status' => 'cancelled'
        ]);
        return redirect()->route('dashboard.reservations.index')->with('success', 'reservations concel avec succes .');
    }




    public function accept(Reservation $reservation)
    {
        DB::transaction(function () use ($reservation) {

            $reservation->update([
                'status' => 'confirmed'
            ]);

            // dd($reservation);
            Payment::update([
                'reservation_id' => $reservation->id,
                'amount' => $reservation->total_price,
                'status' => 'unpaid'
            ]);

            Reservation::where('room_id', $reservation->room_id)
                ->where('id', '!=', $reservation->id)
                ->where('status', 'pending')
                ->where(function ($query) use ($reservation) {

                    $query->where('check_in', '<', $reservation->check_out)
                        ->where('check_out', '>', $reservation->check_in);
                })
                ->update([
                    'status' => 'cancelled'
                ]);
        });

        return back()->with('success', 'Reservation accepted & payment created');
    }





    public function create()
    {
        $clients = User::where('role', 'client')
            ->where('is_banned', false)
            ->get();
        $rooms = Room::where('status', 'available')
            ->get();
        return view(
            'Dashboard.reservations.create',
            compact('clients', 'rooms')
        );
    }






    public function store(receReservationsRequest $request)
    {
        $room = Room::findOrFail($request->room_id);

        $checkIn = Carbon::parse($request->check_in);
        $checkOut = Carbon::parse($request->check_out);

        $nights = $checkIn->diffInDays($checkOut);
        $totalPrice = $room->price * $nights;

        DB::transaction(function () use (
            $request,
            $room,
            $checkIn,
            $checkOut,
            $totalPrice
        ) {

            $reservation = Reservation::create([
                'user_id' => $request->client_id,
                'room_id' => $room->id,
                'check_in' => $checkIn,
                'check_out' => $checkOut,
                'total_price' => $totalPrice,
                'status' => 'confirmed',
            ]);

            Reservation::where('room_id', $room->id)
                ->where('status', 'pending')
                ->where(function ($query) use ($checkIn, $checkOut) {

                    $query->whereBetween('check_in', [$checkIn, $checkOut])
                        ->orWhereBetween('check_out', [$checkIn, $checkOut])
                        ->orWhere(function ($q) use ($checkIn, $checkOut) {
                            $q->where('check_in', '<=', $checkIn)
                                ->where('check_out', '>=', $checkOut);
                        });
                })
                ->update([
                    'status' => 'cancelled'
                ]);

            $room->update([
                'status' => 'occupied'
            ]);

            $reservation->payment()->create([
                'amount' => $totalPrice,
                'status' => 'unpaid'
            ]);
        });

        return back()->with('success', 'Reservation confirmed successfully');
    }
}
