<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Ticket;
use App\Models\Admin;
use App\Models\TicketAssignment;

class TicketAssign extends Component
{
    public Ticket $ticket;
    public $admin_id;

    protected $rules = [
        'admin_id' => 'required|exists:admins,id'
    ];

    public function assign()
    {
        $this->validate();

        TicketAssignment::create([
            'ticket_id' => $this->ticket->id,
            'admin_id' => $this->admin_id,
            'assigned_at' => now(),
        ]);

        return redirect()->route('tickets.index');
    }

    public function render()
    {
        return view('livewire.pages.ticket-assign', [
            'admins' => Admin::all()
        ])->layout('components.layouts.dashboard');
    }
}
