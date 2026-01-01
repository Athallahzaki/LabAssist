<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    protected $fillable = [
        'booking_id',
        'admin_id',
        'approval_status_id',
        'message',
        'approved_at',
    ];

    protected $casts = [
        'approved_at' => 'datetime',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'approval_status_id');
    }
}
