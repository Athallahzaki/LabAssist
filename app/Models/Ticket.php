<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'student_id',
        'lab_id',
        'title',
        'description',
        'ticket_status_id',
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
        return $this->belongsTo(Status::class, 'ticket_status_id');
    }

    public function assignments()
    {
        return $this->hasMany(TicketAssignment::class);
    }
}
