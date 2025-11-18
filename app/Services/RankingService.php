<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;

class RankingService
{
    public function updateRankingList(): void
    {
        $users = User::all()->sortByDesc('portfolio_value')->values();
    
        foreach ($users as $index => $user) {
            $user->ranking = $index + 1;
            $user->save();
        }
    }

    public function getRankingList(): Collection
    {
        $userRankings = User::all()->map(fn($user) => [
            'user_id' => $user->id,
            'username' => $user->username,
            'portfolio_value' => $user->portfolio_value,
            'portfolio_gain' => $user->portfolio_gain,
            'portfolio_gain_percentage' => $user->portfolio_gain_percentage,
            'transactions' => count($user->transactions),
            'ranking' => $user->ranking,
        ])->sortByDesc('portfolio_value')
        ->values(); // Reset de index sleutels naar 1,2,3,etc na sortBy

        return $userRankings;
    }
}
