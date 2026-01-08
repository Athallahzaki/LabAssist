<?php

namespace App\Livewire\Pages\Approval;

use Livewire\Component;
use App\Models\Approval;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;


class BookingApprovalHistory extends Component
{
    #[Title('Approval Booking History')]
    #[Layout('components.layouts.dashboard')]

    public $approvals;

    public function mount() {
        $this->approvals = Approval::with(['booking.student', 'booking.lab', 'status', 'admin'])
                ->latest('approved_at')
                ->get();
    }

    public function render()
    {
        return view('livewire.pages.approval.booking-approval-history');
    }
}
