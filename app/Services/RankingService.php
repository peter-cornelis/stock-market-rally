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
        ->orderBy('ranking', 'asc')
        ->paginate(15);

        return $userRankings;
    }

    public function getRankingListByUsername(string $query): LengthAwarePaginator
    {
        $userRankings = User::query()
        ->withCount('transactions')
        ->where('username', 'like', '%'.$query.'%')
        ->orderBy('ranking', 'asc')
        ->paginate(15);

        return $userRankings;
    }
}
