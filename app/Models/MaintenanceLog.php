<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaintenanceLog extends Model
{
    protected $fillable = [
        'ticket_id',
        'admin_id',
        'description',
        'is_final',
    ];

    protected $casts = [
        'is_final' => 'boolean',
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
