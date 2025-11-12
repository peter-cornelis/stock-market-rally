<?php

use App\Http\Controllers\EquityController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/equities', [EquityController::class, 'index']);