<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    protected $fillable = [
        'lab_name',
        'capacity',
        'lab_status_id',
    ];

    public function status()
    {
        return $this->belongsTo(Status::class, 'lab_status_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
