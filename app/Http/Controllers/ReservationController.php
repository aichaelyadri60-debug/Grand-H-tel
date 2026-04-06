<?php

namespace App\Http\Controllers;

use App\Http\Requests\reservationrequest;
use App\Models\Reservation;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;

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

        return view('receptionist.reservations', compact('reservations'));
    }

    public function formReserv(Room $room)
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('Showlogin');
        }
        $room = Room::findOrFail($room->id);
        return view('reservation.create', compact('room'));
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

        if ($alreadyConfirmed ) {
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

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('Reservations.index')->with('success', 'reservations supprimer avec succes .');
    }
}
