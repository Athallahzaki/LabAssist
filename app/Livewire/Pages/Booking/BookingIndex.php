<?php

namespace App\Livewire\Pages\Booking;

use Livewire\Component;
use App\Models\Booking;
use Livewire\Attributes\Title;

class BookingIndex extends Component
{
    #[Title('Bookings')]

    public $bookings;

    public function mount() {
        if (auth()->user()->isStudent()) {
            $this->bookings = Booking::where('student_id', auth()->user()->student->id)
                    ->with(['student', 'lab', 'status'])
                    ->orderBy('booking_date', 'desc')
                    ->get();
        } else {
            $this->bookings = Booking::with(['student', 'lab', 'status'])
                    ->orderBy('booking_date', 'desc')
                    ->get();
        }
    }

    public function delete($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        $this->bookings = $this->bookings->where('id', '!=', $id);

        Toaster::success('booking berhasil dihapus.');
    }
    
    public function render()
    {
        return view('livewire.pages.booking.booking-index')
            ->layout('components.layouts.dashboard');
    }
}
