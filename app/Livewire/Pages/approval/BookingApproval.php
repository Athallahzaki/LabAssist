<?php

namespace App\Livewire\Pages\Approval;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Services\BookingApprovalService;
use App\Models\Booking;


class BookingApproval extends Component
{
    #[Title('Approval Booking')]
    #[Layout('components.layouts.dashboard')]

    public $message = '';

    protected $rules = [
        'message' => 'nullable|string|max:500',
    ];

    public function approve($bookingId, BookingApprovalService $service)
    {
        $this->validate();

        $service->approve(
            $bookingId,
            auth()->user()->admin->id,
            $this->message
        );

        $this->afterAction();
    }

    public function reject($bookingId, BookingApprovalService $service)
    {
        $this->validate();

        $service->reject(
            $bookingId,
            auth()->user()->admin->id,
            $this->message
        );

        $this->afterAction();
    }

    private function afterAction(): void
    {
        $this->reset('message');
        session()->flash('success', 'Booking berhasil diproses.');
    }

    public function render()
    {
        return view('livewire.pages.approval.booking-approval', [
            'bookings' => Booking::with(['student.user', 'lab', 'status'])
                ->whereHas('status', fn ($q) =>
                    $q->where('group', 'booking')->where('code', 'pending')
                )
                ->get(),
        ]);
    }
}