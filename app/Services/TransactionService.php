<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class TransactionService
{
    public function __construct()
    {
    }

    public function buyEquity(int $quantity, float $buy_price, int $equity_id)
    {
        $cost = ($quantity * $buy_price);
        $user = Auth::user();
        if($user->balance < $cost) {
            throw ValidationException::withMessages([
                'quantity' => 'Saldo ontoereikend.'
            ]);
        }

        $user->balance = $user->balance - $cost;

        $user->equities()->updateExistingPivot(
            $equity_id, ['quantity' => $quantity, 'buyPrice' => $buy_price]);
    }
}
