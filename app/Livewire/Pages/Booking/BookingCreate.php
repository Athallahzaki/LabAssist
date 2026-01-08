<?php

namespace App\Livewire\Pages\Booking;

use Livewire\Component;
use App\Models\Booking;
use App\Models\Student;
use App\Models\Lab;
use App\Models\Status;
use Masmerise\Toaster\Toaster;

class BookingCreate extends Component
{
    #[Title('Create Booking')]

    public $student_id;
    public $lab_id;
    public $booking_date;
    public $booking_time_start;
    public $booking_time_end;
    public $booking_status_id;

    public $students, $labs, $statuses;

    protected $rules = [
        'student_id' => 'required|exists:students,id',
        'lab_id' => 'required|exists:labs,id',
        'booking_date' => 'required|date',
        'booking_time_start' => 'required',
        'booking_time_end' => 'required|after:booking_time_start',
        'booking_status_id' => 'required|exists:statuses,id',
    ];

    public function mount() {
        $this->students = Student::all();
        $this->labs = Lab::all();
        $this->statuses = Status::group('booking')->get();
    }

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

        Toaster::success('Booking berhasil ditambahkan.');
        return redirect()->route('booking.index');
    }

    public function render()
    {
        return view('livewire.pages.booking.booking-create')
        ->layout('components.layouts.dashboard');
    }
}
