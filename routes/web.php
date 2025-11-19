<?php

use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\EquityController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('home');
//});

Route::get('/portfolio', [PortfolioController::class, 'index'])->middleware('auth');
Route::get('/ranking', [RankingController::class, 'index']);

//Equity
Route::get('/equities', [EquityController::class, 'index']);
Route::get('/', [EquityController::class, 'home']);
Route::middleware('auth')->group(function () {
    Route::get('/equities/create', [EquityController::class, 'create']);
    Route::post('/equities', [EquityController::class, 'store']);
    Route::get('/equities/{equity}', [EquityController::class, 'show']);
});

//Transactions
Route::middleware('auth')->group(function () {
    Route::get('/users/{user}/transactions', [TransactionController::class, 'index']);
    Route::get('/transactions/create/{equity}', [TransactionController::class, 'create']);
    Route::post('/transactions/{equity}', [TransactionController::class, 'store']);
});

// Auth
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create']);
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store']);
});
Route::delete('/logout', [SessionController::class, 'destroy'])->middleware('auth');