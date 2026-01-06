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

    Route::post('/logout', function () {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login');
    })->name('logout');
});