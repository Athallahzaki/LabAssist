<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/bookings', fn () =>
    \App\Models\Booking::with(['student','lab','status'])
        ->where('is_deleted', false)
        ->get()
);

Route::get('/bookings/{id}', fn ($id) =>
    \App\Models\Booking::with(['student','lab','status'])
        ->where('id', $id)
        ->where('is_deleted', false)
        ->firstOrFail()
);
