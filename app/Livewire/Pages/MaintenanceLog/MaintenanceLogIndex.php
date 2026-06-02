<?php

namespace App\Livewire\Pages\MaintenanceLog;

use App\Models\Ticket;
use Livewire\Component;
use App\Models\MaintenanceLog;
use App\Models\Status;
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

            $status = Status::where('group', 'ticket') // pastikan kolomnya bernama 'group'
                            ->where('code', 'finished')
                            ->firstOrFail();

            $this->assignedTickets = Ticket::with([
                                'lab',
                                'status',
                                'maintenanceLogs'
                            ])
                            ->where(function ($query) use ($adminId, $status) {
                                $query->where('assigned_admin_id', $adminId)
                                    ->orWhere('ticket_status_id', $status->id); // Sesuaikan 'status_id' dengan nama foreign key di tabel tiket Anda
                            })
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