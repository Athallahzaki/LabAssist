<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Booking;

class BookingIndex extends Component
{
    public function render()
    {
        return view('livewire.booking-index', [
            'bookings' => Booking::with(['student', 'lab', 'status'])
                ->orderBy('booking_date', 'desc')
                ->get()
        ])->layout('components.layouts.dashboard');
    }
}
