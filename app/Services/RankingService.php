<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Collection;

class RankingService
{
    public function getRankingList(): Collection
    {
        $rankings = User::all()->map(fn($user) => [
            'user_id' => $user->id,
            'username' => $user->first_name,
            'portfolio_value' => $user->portfolio_value,
            'portfolio_gain' => $user->portfolio_gain,
            'portfolio_gain_percentage' => $user->portfolio_gain_percentage,
            'transactions' => count($user->transactions)
        ])->sortByDesc('portfolio_value');

        return $rankings;
    }

    public function getUserRanking(int $userId): int
    {
        foreach ($this->getRankingList() as $index => $user) {
            if ($user['user_id'] === $userId)  return (int) $index + 1;
        }

        return 0;
    }
}
