<?php

namespace App\Livewire\Pages\MaintenanceLog;

use App\Models\Ticket;
use Livewire\Component;
use App\Models\MaintenanceLog;
use Livewire\Attributes\Title;

class MaintenanceLogIndex extends Component
{
    #[Title('Maintenance Logs')]

    public $assignedTickets = [];

    public $logs = [];

    public function mount()
    {
        /*
        |--------------------------------------------------------------------------
        | ASSIGNED TICKETS
        |--------------------------------------------------------------------------
        */

        if (auth()->user()->isAdmin()) {

            $adminId = auth()->user()->admin->id;

            $this->assignedTickets = Ticket::with([
                    'lab',
                    'status',
                    'maintenanceLogs'
                ])
                ->where('assigned_admin_id', $adminId)
                ->latest()
                ->get();
        }

        /*
        |--------------------------------------------------------------------------
        | MAINTENANCE LOGS
        |--------------------------------------------------------------------------
        */

        $this->logs = MaintenanceLog::with([
                'ticket.lab',
                'admin',
            ])
            ->latest()
            ->get();
    }

    public function render()
    {
        return view(
            'livewire.pages.maintenance-log.maintenance-log-index'
        )->layout('components.layouts.dashboard');
    }
}