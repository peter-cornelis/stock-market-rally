<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EquityController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

//Equity
Route::get('/equities', [EquityController::class, 'index']);
Route::get('/equities/{equity}', [EquityController::class, 'show']);

//Transactions
Route::get('/transactions/create/{equity}', [TransactionController::class, 'create']);

// Auth
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create']);
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store']);
});
Route::delete('/logout', [SessionController::class, 'destroy'])->middleware('auth');