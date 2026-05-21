<?php

namespace App\Livewire\Pages\Ticket;

use Livewire\Component;
use App\Models\Ticket;
use App\Models\Admin;
use App\Models\Status;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Masmerise\Toaster\Toaster;

class TicketAssign extends Component
{
    #[Title('Assign Ticket')]
    
    public Ticket $ticket;
    public $admin_id;
    public $admins;

    protected $rules = [
        'admin_id' => 'required|exists:admins,id'
    ];

    public function mount() {
        $this->admins = Admin::all();
        $this->admin_id = $this->ticket->assigned_admin_id;
    }

    public function assign()
    {
        $this->validate();

        DB::transaction(function () {

            $status = Status::where('group', 'ticket')
                ->where('code', 'in_progress')
                ->firstOrFail();

            $this->ticket->update([
                'assigned_admin_id' => $this->admin_id,
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
