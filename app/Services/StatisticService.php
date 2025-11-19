<?php

namespace App\Services;

use App\Models\Transaction;
use App\Models\User;

class StatisticService
{
    private string $currentYear;

    public function __construct()
    {
        $this->currentYear = now()->year;
    }

    private function getTotalTransactions(): int
    {
        return Transaction::whereYear('executed_at', $this->currentYear)
            ->count();
    }

    private function getTotalActiveUsers(): int
    {
        return Transaction::whereYear('executed_at',  $this->currentYear)
            ->distinct('user_id')
            ->count('user_id');
    }

    private function getHighestRankingUser(): array
    {
        $firstUser = User::query()
            ->where('ranking', 1)
            ->first();
            
        return [
            'username' => $firstUser->username,
            'portfolio_value' => $firstUser->portfolio_value
        ];
    }

    public function getAll(): array
    {
        $highestRanked = $this->getHighestRankingUser();

        return [
            'totalTransactions' => $this->getTotalTransactions(),
            'totalActiveUsers' => $this->getTotalActiveUsers(),
            'highestRankedUsername' => $highestRanked['username'],
            'highestRankedPortfolioValue' => $highestRanked['portfolio_value']
        ];
    }
}
