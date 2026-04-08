<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomRequest;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query =Room::query();
        if($request->type){
            $query->where('type' ,$request->type);
        }
        $rooms = $query->orderBy('created_at', 'desc')->paginate(6);

        return view('room.list', compact('rooms'));
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
    public function store(RoomRequest $request)
    {
        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')
                ->store('rooms', 'public');
        }

        Room::create([
            'roomNumber' => $request->roomNumber,
            'type' => $request->type,
            'price' => $request->price,
            'status' => $request->status,
            'image' => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Room created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        return view('Dashboard.room.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        $room->roomNumber = $request->roomNumber;
        $room->type = $request->type;
        $room->price = $request->price;
        $room->status = $request->status;
        $room->save();
        return redirect()
            ->back()
            ->with('succes', 'chambre modifier avec succes');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->back()->with('success', 'chambre supprimer avec success');
    }
}
