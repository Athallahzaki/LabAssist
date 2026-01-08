<?php

namespace App\Livewire\Pages\Booking;

use Livewire\Component;
use App\Models\Booking;
use App\Models\Student;
use App\Models\Lab;
use App\Models\Status;
use Livewire\Attributes\Title;
use Masmerise\Toaster\Toaster;

class BookingEdit extends Component
{
    #[Title('Edit Booking')]
    
    public Booking $booking;

    public $student_id;
    public $lab_id;
    public $booking_date;
    public $booking_time_start;
    public $booking_time_end;
    public $booking_status_id;

    public $students, $labs, $statuses;

    protected $rules = [
        'student_id' => 'required',
        'lab_id' => 'required',
        'booking_date' => 'required|date',
        'booking_time_start' => 'required',
        'booking_time_end' => 'required|after:booking.booking_time_start',
        'booking_status_id' => 'required',
    ];

    public function mount($booking)
    {
        $this->student_id = $booking->student_id;
        $this->lab_id = $booking->lab_id;
        $this->booking_date = $booking->booking_date->format('Y-m-d');
        $this->booking_time_start = $booking->booking_time_start;
        $this->booking_time_end = $booking->booking_time_end;
        $this->booking_status_id = $booking->booking_status_id;

        $this->students = Student::all();
        $this->labs = Lab::all();
        $this->statuses = Status::group('booking')->get();
    }

    public function update()
    {
        $this->validate();
        $this->booking->update([
            'student_id' => $this->student_id,
            'lab_id' => $this->lab_id,
            'booking_date' => $this->booking_date,
            'booking_time_start' => $this->booking_time_start,
            'booking_time_end' => $this->booking_time_end,
            'booking_status_id' => $this->booking_status_id,
        ]);

        Toaster::success('Booking berhasil diubah');
        return redirect()->route('booking.index');
    }

    public function render()
    {
        return view('livewire.pages.booking.booking-edit')
            ->layout('components.layouts.dashboard');
    }
}
