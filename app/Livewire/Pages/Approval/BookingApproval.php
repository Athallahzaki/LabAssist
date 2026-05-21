<?php

namespace App\Livewire\Pages\Approval;

use Livewire\Component;
use App\Models\Booking;
use App\Models\Approval;
use App\Models\Status;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Masmerise\Toaster\Toaster;

class BookingApproval extends Component
{
    #[Title('Approval Booking')]
    #[Layout('components.layouts.dashboard')]
    public $message = '';
    public $bookings;

    protected $rules = [
        'message' => 'nullable|string|max:500',
    ];

    public function mount() {
        $bookingPendingStatus = Status::where('group', 'booking')->where('code', 'pending')->firstOrFail();
        $this->bookings = Booking::with(['student', 'lab', 'status'])
                ->where('booking_status_id', $bookingPendingStatus->id)
                ->get();
    }

    public function approve($bookingId)
    {
        $this->process($bookingId, 'approved');
    }

    public function reject($bookingId)
    {
        $this->process($bookingId, 'rejected');
    }

    private function process($bookingId, string $action)
    {
        $this->validate();

        DB::transaction(function () use ($bookingId, $action) {

            $booking = Booking::with('status')->findOrFail($bookingId);

            $bookingStatus = Status::where('group', 'booking')->where('code', $action)->firstOrFail();
            $approvalStatus = Status::where('group', 'approval')->where('code', $action)->firstOrFail();

            // Update booking status
            $booking->update([
                'booking_status_id' => $bookingStatus->id,
            ]);

            // Create approval
            Approval::create([
                'booking_id' => $booking->id,
                'admin_id' => auth()->user()->admin->id,
                'approval_status_id' => $approvalStatus->id,
                'message' => $this->message,
                'approved_at' => now(),
            ]);

            $this->bookings = $this->bookings->where('id', '!=', $booking->id);
        });

        $this->reset('message');
        Toaster::success('Booking berhasl diproses.');
    }

    public function render()
    {
        return view('livewire.pages.approval.booking-approval');
    }
}
