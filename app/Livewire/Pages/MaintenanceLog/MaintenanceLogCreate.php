<?php

namespace App\Livewire\Pages\MaintenanceLog;

use App\Models\Ticket;
use Livewire\Component;
use Livewire\Attributes\Title;
use App\Services\MaintenanceLogService;
use Masmerise\Toaster\Toaster;

class MaintenanceLogCreate extends Component
{
    #[Title('Create Maintenance Log')]

    public Ticket $ticket;

    public $description = '';

    public $is_final = false;

    protected $rules = [
        'description' => 'required|string|min:5',
        'is_final' => 'boolean',
    ];

    public function mount(Ticket $ticket)
    {
        $this->ticket = $ticket;

        abort_unless(
            $ticket->assigned_admin_id === auth()->user()->admin->id,
            403
        );
    }

    public function save(
        MaintenanceLogService $service
    )
    {
        $this->validate();

        try {

            $service->create(
                ticket: $this->ticket,
                adminId: auth()->user()->admin->id,
                description: $this->description,
                isFinal: $this->is_final,
            );

            Toaster::success(
                'Maintenance log berhasil dibuat.'
            );

            return redirect()->route(
                'maintenance-logs.index'
            );

        } catch (\Exception $e) {

            Toaster::error($e->getMessage());
        }
    }

    public function render()
    {
        return view(
            'livewire.pages.maintenance-log.maintenance-log-create'
        )->layout('components.layouts.dashboard');
    }
}