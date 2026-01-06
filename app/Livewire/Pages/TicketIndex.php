<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Ticket;

class TicketIndex extends Component
{
    public function delete($id)
    {
        Ticket::findOrFail($id)->delete();
    }

    public function render()
    {
        return view('livewire.pages.ticket-index', [
            'tickets' => Ticket::with(['student', 'lab', 'status'])->get()
        ])->layout('components.layouts.dashboard');
    }
}
