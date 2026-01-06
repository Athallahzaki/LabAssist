<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Ticket;
use App\Models\Student;
use App\Models\Lab;
use App\Models\Status;

class TicketCreate extends Component
{
    public $student_id, $lab_id, $title, $description, $ticket_status_id;

    protected $rules = [
        'student_id' => 'required|exists:students,id',
        'lab_id' => 'required|exists:labs,id',
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'ticket_status_id' => 'required|exists:statuses,id',
    ];

    public function save()
    {
        $this->validate();

        Ticket::create([
            'student_id' => $this->student_id,
            'lab_id' => $this->lab_id,
            'title' => $this->title,
            'description' => $this->description,
            'ticket_status_id' => $this->ticket_status_id,
        ]);

        return redirect()->route('tickets.index');
    }

    public function render()
    {
        return view('livewire.pages.ticket-create', [
            'students' => Student::all(),
            'labs' => Lab::all(),
            'statuses' => Status::all(),
        ])->layout('components.layouts.dashboard');
    }
}
