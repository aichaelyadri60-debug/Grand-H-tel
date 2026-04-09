<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'reservation_id',
        'amount',
        'status',
        'method',
        'paid_at'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
}
