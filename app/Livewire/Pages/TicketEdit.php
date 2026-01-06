<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Ticket;
use App\Models\Status;

class TicketEdit extends Component
{
    public Ticket $ticket;

    protected $rules = [
        'ticket.title' => 'required',
        'ticket.description' => 'required',
        'ticket.ticket_status_id' => 'required|exists:statuses,id',
    ];

    public function save()
    {
        $this->validate();
        $this->ticket->save();

        return redirect()->route('tickets.index');
    }

    public function render()
    {
        return view('livewire.pages.ticket-edit', [
            'statuses' => Status::all()
        ])->layout('components.layouts.dashboard');
    }
}
