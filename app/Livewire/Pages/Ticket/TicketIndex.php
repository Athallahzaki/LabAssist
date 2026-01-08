<?php

namespace App\Livewire\Pages\Ticket;

use Livewire\Component;
use App\Models\Ticket;
use Livewire\Attributes\Title;
use Masmerise\Toaster\Toaster;

class TicketIndex extends Component
{
    #[Title('Tickets')]
    
    public $tickets;

    public function mount() {
        if (auth()->user()->isStudent()) {
            $this->tickets = Ticket::where('student_id', auth()->user()->student->id)
                    ->with(['student', 'lab', 'status', 'assignments.admin'])
                    ->get();
        } else {
            $this->tickets = Ticket::with(['student', 'lab', 'status', 'assignments.admin'])
                    ->get();
        }
    }
    
    public function delete($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();

        $this->tickets = $this->tickets->where('id', '!=', $id);

        Toaster::success('Ticket berhasil dihapus.');
    }

    public function render()
    {
        return view('livewire.pages.ticket.ticket-index')
            ->layout('components.layouts.dashboard');
    }
}
