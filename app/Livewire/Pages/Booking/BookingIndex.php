<?php

namespace App\Livewire\Pages\Booking;

use Livewire\Component;
use App\Models\Booking;
use Livewire\Attributes\Title;

class BookingIndex extends Component
{
    #[Title('Bookings')]
    
    public function render()
    {
        return view('livewire.pages.booking.booking-index', [
            'bookings' => Booking::with(['student', 'lab', 'status'])
                ->orderBy('booking_date', 'desc')
                ->get()
        ])->layout('components.layouts.dashboard');
    }
}
