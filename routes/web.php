<?php

use App\Livewire\Pages\Auth\Login;
use App\Livewire\Pages\Auth\Register;
use App\Livewire\Pages\ExamplePage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\TicketIndex;
use App\Livewire\Pages\TicketCreate;
use App\Livewire\Pages\TicketEdit;
use App\Livewire\Pages\TicketAssign;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});

Route::middleware(['auth', 'role:admin,student'])->group(function () {
    Route::get('/dashboard', ExamplePage::class)->name('dashboard');

    Route::post('/logout', function () {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login');
    })->name('logout');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/tickets', TicketIndex::class)->name('tickets.index');
    Route::get('/tickets/create', TicketCreate::class)->name('tickets.create');
    Route::get('/tickets/{ticket}/edit', TicketEdit::class)->name('tickets.edit');
    Route::get('/tickets/{ticket}/assign', TicketAssign::class)->name('tickets.assign');
});