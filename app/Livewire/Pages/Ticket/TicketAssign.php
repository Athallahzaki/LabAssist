<?php

namespace App\Livewire\Pages\Ticket;

use Livewire\Component;
use App\Models\Ticket;
use App\Models\Admin;
use App\Models\Status;
use App\Models\TicketAssignment;
use Illuminate\Support\Facades\DB;
use Masmerise\Toaster\Toaster;

class TicketAssign extends Component
{
    public Ticket $ticket;
    public $admin_id;
    public $admins;

    protected $rules = [
        'admin_id' => 'required|exists:admins,id'
    ];

    public function mount() {
        $this->admins = Admin::all();
    }

    public function assign()
    {
        $this->validate();

        DB::transaction(function () {

            TicketAssignment::create([
                'ticket_id' => $this->ticket->id,
                'admin_id' => $this->admin_id,
                'assigned_at' => now(),
            ]);

            $status = Status::group('ticket')
                ->where('code', 'in_progress')
                ->firstOrFail();

            $this->ticket->update([
                'ticket_status_id' => $status->id
            ]);
        });

        Toaster::success('Ticket berhasil di assign.');

        return redirect()->route('tickets.index');
    }

    public function render()
    {
        return view('livewire.pages.ticket.ticket-assign')
            ->layout('components.layouts.dashboard');
    }
}
