<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    LabController,
    BookingController,
    TicketController,
    ApprovalController,
    AuthController
};

Route::middleware('guest')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware(['auth:sanctum', 'role:admin,student'])->group(function () {
    // Labs (read-only for students)
    Route::get('/labs', [LabController::class, 'index']);
    Route::get('/labs/{lab}', [LabController::class, 'show']);

    // Bookings
    Route::get('/bookings', [BookingController::class, 'index']);
    Route::post('/bookings', [BookingController::class, 'store']);
    Route::get('/bookings/{booking}', [BookingController::class, 'show']);

    // Tickets
    Route::get('/tickets', [TicketController::class, 'index']);
    Route::post('/tickets', [TicketController::class, 'store']);
    Route::get('/tickets/{ticket}', [TicketController::class, 'show']);

    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {

    // Labs
    Route::post('/labs', [LabController::class, 'store']);
    Route::put('/labs/{lab}', [LabController::class, 'update']);
    Route::delete('/labs/{lab}', [LabController::class, 'destroy']);

    // Booking approval
    Route::get('/approvals', [ApprovalController::class, 'index']);
    Route::get('/approvals/history', [ApprovalController::class, 'history']);
    Route::put('/bookings/{booking}', [BookingController::class, 'update']);

    // Tickets
    Route::put('/tickets/{ticket}', [TicketController::class, 'update']);
    Route::post('/tickets/{ticket}/assign', [TicketController::class, 'assign']);
});