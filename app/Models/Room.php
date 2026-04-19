<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'roomNumber',
        'type',
        'price',
        'status',
        'image'
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function isOccupied()
    {
        return $this->reservations()
            ->whereIn('status', ['confirmed', 'checked_in'])
            ->where('check_in', '<=', now())
            ->where('check_out', '>', now())
            ->exists();
    }
}
