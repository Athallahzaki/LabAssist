<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'user_id',
        'display_name',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approvals()
    {
        return $this->hasMany(Approval::class);
    }

    public function ticketAssignments()
    {
        return $this->hasMany(TicketAssignment::class);
    }
}
