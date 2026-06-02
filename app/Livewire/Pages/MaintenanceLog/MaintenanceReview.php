<?php

namespace App\Livewire\Pages\MaintenanceLog;

use App\Models\Ticket;
use App\Models\Status;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\Title;
use Masmerise\Toaster\Toaster;

class MaintenanceReview extends Component
{
    #[Title('Review Maintenance')]

    public Ticket $ticket;

    public $finalLog;

    public function mount(Ticket $ticket)
    {
        $ticket->load([
            'student',
            'lab',
            'status',
            'assignedAdmin',
            'maintenanceLogs.admin'
        ]);

        abort_unless(
            auth()->user()->isAdmin(),
            403
        );

        abort_unless(
            $ticket->canBeReviewed(),
            403
        );

        $this->ticket = $ticket;

        $this->finalLog = $ticket->maintenanceLogs
            ->where('is_final', true)
            ->sortByDesc('created_at')
            ->first();
    }

    public function approve()
    {
        DB::transaction(function () {

            $resolved = Status::group('ticket')
                ->where('code', 'resolved')
                ->firstOrFail();

            $available = Status::group('lab')
                ->where('code', 'available')
                ->firstOrFail();

            $this->ticket->update([
                'ticket_status_id' => $resolved->id
            ]);

            $this->ticket->lab->update([
                'lab_status_id' => $available->id
            ]);
        });

        Toaster::success(
            'Maintenance berhasil disetujui.'
        );

        return redirect()->route(
            'maintenance-logs.index'
        );
    }

    public function reject()
    {
        DB::transaction(function () {

            $progress = Status::group('ticket')
                ->where('code', 'in_progress')
                ->firstOrFail();

            $maintenance = Status::group('lab')
                ->where('code', 'maintenance')
                ->firstOrFail();

            $this->ticket->update([
                'ticket_status_id' => $progress->id
            ]);

            $this->ticket->lab->update([
                'lab_status_id' => $maintenance->id
            ]);
        });

        Toaster::warning(
            'Maintenance dikembalikan untuk perbaikan.'
        );

        return redirect()->route(
            'maintenance-logs.index'
        );
    }

    public function render()
    {
        return view(
            'livewire.pages.maintenance-log.maintenance-review'
        )->layout(
            'components.layouts.dashboard'
        );
    }
}