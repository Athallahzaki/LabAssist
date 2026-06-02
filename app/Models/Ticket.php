<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'student_id',
        'lab_id',
        'assigned_admin_id',
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
    
    public function maintenanceLogs()
    {
        return $this->hasMany(MaintenanceLog::class);
    }

    public function assignedAdmin()
    {
        return $this->belongsTo(Admin::class, 'assigned_admin_id');
    }

    public function canCreateMaintenanceLog(Admin $admin): bool
    {
        return
            $this->assigned_admin_id === $admin->id
            && $this->status->code === 'in_progress';
    }

    public function canBeReviewed(): bool
    {
        return $this->status?->code === 'finished';
    }

    public function isDone(): bool
    {
        return 
            $this->status?->code === 'resolved'
            || $this->status?->code === 'closed';
    }
}

