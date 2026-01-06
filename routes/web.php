<?php

use App\Livewire\Pages\Auth\Login;
use App\Livewire\Pages\Auth\Register;
use App\Livewire\Pages\ExamplePage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});

Route::middleware(['auth', 'role:admin,student'])->group(function () {
    Route::get('/dashboard', ExamplePage::class)->name('dashboard');
    Route::get('/labs', \App\Livewire\Pages\Lab\LabIndex::class)->name('labs.index');
    Route::get('/labs/create', \App\Livewire\Pages\Lab\LabCreate::class)->name('labs.create');
    Route::get('/labs/{lab}/edit', \App\Livewire\Pages\Lab\LabEdit::class)->name('labs.edit');

    Route::post('/logout', function () {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login');
    })->name('logout');
});