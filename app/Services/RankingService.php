<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

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

    public function getRankingList(): Builder
    {
        $userRankings = User::query()
            ->withCount('transactions')
            ->orderBy('ranking', 'asc');

        return $userRankings;
    }

    public function getRankingListByUsername(string $query): Builder
    {
        $userRankings = User::query()
            ->withCount('transactions')
            ->where('username', 'like', '%'.$query.'%')
            ->orderBy('ranking', 'asc');

        return $userRankings;
    }
}
