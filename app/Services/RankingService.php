<?php

declare(strict_types=1);

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
        return User::query()
            ->where('ranking', '!=')
            ->withCount('transactions')
            ->orderBy('ranking', 'asc');
    }

    public function getRankingListByUsername(string $query): Builder
    {
        return User::query()
            ->withCount('transactions')
            ->where('username', 'like', '%'.$query.'%')
            ->orderBy('ranking', 'asc');
    }
}
