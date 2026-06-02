<?php

namespace App\Livewire\Pages\Ticket;

use App\Models\Ticket;
use Livewire\Component;
use Livewire\Attributes\Title;

class TicketShow extends Component
{
    #[Title('Detail Ticket')]

    public Ticket $ticket;

    public function mount(Ticket $ticket)
    {
        $this->ticket = $ticket->load([
            'student',
            'lab',
            'status',
            'assignedAdmin',
            'maintenanceLogs.admin'
        ]);
    }

    public function render()
    {
        return view('livewire.pages.ticket.ticket-show')
            ->layout('components.layouts.dashboard');
    }
}