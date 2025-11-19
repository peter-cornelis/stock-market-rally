<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

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

    public function getRankingList(): LengthAwarePaginator
    {
        $userRankings = User::query()
        ->withCount('transactions')
        ->with(['equities.charts' => fn($q) => $q->latest('date')->limit(2)])
        ->orderBy('ranking', 'asc')
        ->paginate(15);

        return $userRankings;
    }
}
