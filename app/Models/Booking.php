<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'student_id',
        'lab_id',
        'booking_date',
        'booking_time_start',
        'booking_time_end',
        'booking_status_id',
    ];

    protected $casts = [
        'booking_date' => 'date',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function lab()
    {
        return $this->belongsTo(Lab::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'booking_status_id');
    }

    public function approval()
    {
        return $this->hasOne(Approval::class);
    }

    /* ================= HELPER ================= */

    public function isApproved(): bool
    {
        return $this->status?->code === 'approved';
    }
}
