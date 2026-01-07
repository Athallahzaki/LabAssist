<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Booking;
use App\Models\Student;
use App\Models\Lab;
use App\Models\Status;

class BookingEdit extends Component
{
    public Booking $booking;

    protected $rules = [
        'booking.student_id' => 'required',
        'booking.lab_id' => 'required',
        'booking.booking_date' => 'required|date',
        'booking.booking_time_start' => 'required',
        'booking.booking_time_end' => 'required|after:booking.booking_time_start',
        'booking.booking_status_id' => 'required',
    ];

    public function mount($id)
    {
        $this->booking = Booking::findOrFail($id);
    }

    public function update()
    {
        $this->validate();
        $this->booking->save();

        session()->flash('success', 'Booking berhasil diperbarui');
        return redirect()->route('booking.index');
    }

    public function render()
    {
        return view('livewire.booking-edit', [
            'students' => Student::all(),
            'labs' => Lab::all(),
            'statuses' => Status::group('booking')->get(),
        ])->layout('components.layouts.dashboard');
    }
}
