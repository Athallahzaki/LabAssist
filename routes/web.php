<?php

use App\Livewire\Pages\ExamplePage;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', ExamplePage::class);