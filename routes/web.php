<?php

use App\Livewire\Pages\Auth\Login;
use App\Livewire\Pages\Auth\Register;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\Booking\BookingIndex;
use App\Livewire\Pages\Booking\BookingCreate;
use App\Livewire\Pages\Booking\BookingEdit;
use App\Livewire\Pages\Approval\BookingApproval;
use App\Livewire\Pages\Approval\BookingApprovalHistory;
use App\Livewire\Pages\Dashboard;
use App\Livewire\Pages\Lab\LabCreate;
use App\Livewire\Pages\Lab\LabEdit;
use App\Livewire\Pages\Lab\LabIndex;
use App\Livewire\Pages\MaintenanceLog\MaintenanceLogCreate;
use App\Livewire\Pages\MaintenanceLog\MaintenanceLogEdit;
use App\Livewire\Pages\MaintenanceLog\MaintenanceLogIndex;
use App\Livewire\Pages\Ticket\TicketIndex;
use App\Livewire\Pages\Ticket\TicketCreate;
use App\Livewire\Pages\Ticket\TicketEdit;
use App\Livewire\Pages\Ticket\TicketAssign;
use App\Livewire\Pages\User\UserCreate;
use App\Livewire\Pages\User\UserEdit;
use App\Livewire\Pages\User\UserIndex;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});

Route::middleware(['auth', 'role:admin,student'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    
    Route::get('/labs', LabIndex::class)->name('labs.index');

    Route::get('/booking', BookingIndex::class)->name('booking.index');
    Route::get('/booking/create', BookingCreate::class)->name('booking.create');
    
    Route::get('/tickets', TicketIndex::class)->name('tickets.index');
    Route::get('/tickets/create', TicketCreate::class)->name('tickets.create');

    Route::get('/maintenance-logs', MaintenanceLogIndex::class)->name('maintenance-logs.index');

    Route::post('/logout', function () {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login');
    })->name('logout');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/labs/create', LabCreate::class)->name('labs.create');
    Route::get('/labs/{lab}/edit', LabEdit::class)->name('labs.edit');
    
    Route::get('/approval', BookingApproval::class)->name('approval.index');
    Route::get('/approval/history', BookingApprovalHistory::class)->name('approval.history');
    
    Route::get('/booking/{booking}/edit', BookingEdit::class)->name('booking.edit');
    
    Route::get('/tickets/{ticket}/edit', TicketEdit::class)->name('tickets.edit');
    Route::get('/tickets/{ticket}/assign', TicketAssign::class)->name('tickets.assign');

    Route::get('/maintenance-logs/create/{ticket}', MaintenanceLogCreate::class)->name('maintenance-logs.create');
    Route::get('/maintenance-logs/edit/{maintenanceLog}', MaintenanceLogEdit::class)->name('maintenance-logs.edit');
    
    Route::get('/users', UserIndex::class)->name('users.index');
    Route::get('/users/create', UserCreate::class)->name('users.create');
    Route::get('/users/{user}/edit', UserEdit::class)->name('users.edit');
});

