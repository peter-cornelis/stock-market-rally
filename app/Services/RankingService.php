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
            'transactions' => count($user->transactions),
            'ranking' => 0
        ])->sortByDesc('portfolio_value')
        ->values() // Reset de index sleutels naar 1,2,3 etc na sortBy
        ->map(fn($ranking, $index) => array_merge($ranking, ['ranking' => $index + 1]));

        return $rankings;
    }

    public function getUserRanking(int $userId): int
    {
        $ranking = $this->getRankingList()->where('user_id', $userId)->first();

        return $ranking['ranking'];
    }
}
