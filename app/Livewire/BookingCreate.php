<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Booking;
use App\Models\Student;
use App\Models\Lab;
use App\Models\Status;

class BookingCreate extends Component
{
    public $student_id;
    public $lab_id;
    public $booking_date;
    public $booking_time_start;
    public $booking_time_end;
    public $booking_status_id;

    protected $rules = [
        'student_id' => 'required|exists:students,id',
        'lab_id' => 'required|exists:labs,id',
        'booking_date' => 'required|date',
        'booking_time_start' => 'required',
        'booking_time_end' => 'required|after:booking_time_start',
        'booking_status_id' => 'required|exists:statuses,id',
    ];

    public function save()
    {
        $this->validate();

        Booking::create([
            'student_id' => $this->student_id,
            'lab_id' => $this->lab_id,
            'booking_date' => $this->booking_date,
            'booking_time_start' => $this->booking_time_start,
            'booking_time_end' => $this->booking_time_end,
            'booking_status_id' => $this->booking_status_id,
        ]);

        session()->flash('success', 'Booking berhasil ditambahkan');
        return redirect()->route('booking.index');
    }

    public function render()
    {
        return view('livewire.booking-create', [
            'students' => Student::get(),
            'labs' => Lab::get(),
            'statuses' => Status::group('booking')->get(),
        ])->layout('components.layouts.dashboard');
    }
}
