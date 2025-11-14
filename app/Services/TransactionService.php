<?php

namespace App\Services;

use App\Models\Equity;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class TransactionService
{
    public function __construct()
    {
    }

    public function addTransaction(User $user, Equity $equity, int $quantity, string $type): array
    {
        $total = (float) $quantity * $equity->current_price;
        $fee = round(max($total * 0.0025, 2.5), 2);
        $total = $type === "buy" ? $total + $fee : $total - $fee;

        if($user->balance < $total) {
            throw ValidationException::withMessages([
                'quantity' => 'Saldo ontoereikend.'
            ]);
        }

        $this->updateBalance($user, $type, $total);
        $this->updatePortfolio($user, $equity->id, $type, $quantity, $total);

        $user->transactions()->create([
            'equity_id' => $equity->id,
            'type' => $type,
            'quantity' => $quantity,
            'price' => $equity->current_price,
            'fee' => $fee,
            'total' => $total,
        ]);

        return ['success' => true, 'message' => ($type == 'buy' ? "Aankoop" : "Verkoop") . " succesvol uitgevoerd."];
    }

    private function updateBalance(User $user, string $transactionType, float $transactionTotal): void
    {
        $user->balance = $transactionType == "buy" ? $user->balance - $transactionTotal : $user->balance + $transactionTotal;
        $user->save();
    }

    private function updatePortfolio(User $user, int $equityId, string $transactionType, int $transactionQuantity, float $transactionTotal): void
    {
        $equity = $user->equities()->where('equity_id', $equityId)->first();
        if($equity) {
            $quantity = ($transactionType == 'buy' ? $transactionQuantity + $equity->quantity : $transactionQuantity - $equity->quantity);

            $avgPrice = (float) ($transactionType == 'buy' ? (($equity->quantity * $equity->buy_price) + $transactionTotal) / $quantity : $equity->buy_price);
            if ($quantity == 0) {
                $user->equities()->detach($equityId);
                return;
            }
        }

        $user->equities()->syncWithoutDetaching([
            $equityId => [
                'quantity' => $quantity ?? $transactionQuantity,
                'buy_price' => $avgPrice ?? ($transactionTotal / $transactionQuantity),
            ]
        ]);    
    }
}
