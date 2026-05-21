<?php

namespace App\Livewire\Pages\Ticket;

use Livewire\Component;
use App\Models\Ticket;
use App\Models\Student;
use App\Models\Lab;
use App\Models\Status;
use Livewire\Attributes\Title;
use Masmerise\Toaster\Toaster;

class TicketEdit extends Component
{
    #[Title('Edit Ticket')]
    
    public Ticket $ticket;
    public $student_id, $lab_id, $title, $description, $ticket_status_id;
    public $students;
    public $labs;
    public $statuses;

    protected $rules = [
        'student_id' => 'required|exists:students,id',
        'lab_id' => 'required|exists:labs,id',
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'ticket_status_id' => 'required|exists:statuses,id',
    ];

    public function mount(Ticket $ticket)
    {
        $this->ticket = $ticket;

        $this->student_id = $ticket->student_id;
        $this->lab_id = $ticket->lab_id;
        $this->title = $ticket->title;
        $this->description = $ticket->description;
        $this->ticket_status_id = $ticket->ticket_status_id;

        $this->students = Student::all();
        $this->labs = Lab::all();
        $this->statuses = Status::where('group', 'ticket')->get();
    }

    public function save()
    {
        $this->validate();
        
        $this->ticket->update([
            'student_id' => $this->student_id,
            'lab_id' => $this->lab_id,
            'title' => $this->title,
            'description' => $this->description,
            'ticket_status_id' => $this->ticket_status_id,
        ]);

        Toaster::success('Ticket berhasil diubah.');

        return redirect()->route('tickets.index');
    }

    public function render()
    {
        return view('livewire.pages.ticket.ticket-edit')
            ->layout('components.layouts.dashboard');
    }
}
