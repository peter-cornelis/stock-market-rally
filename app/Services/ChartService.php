<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class ChartService
{
    public function latestTwo($query): Collection
    {
        return $query->latest('date')
            ->limit(2)
            ->get();
    }

    public function period($equity, string $period): Collection
    {
        $dateLimit = match($period) {
            '1M' => now()->subMonth(),
            '3M' => now()->subMonths(3),
            '6M' => now()->subMonths(6),
            'YTD' => now()->startOfYear(),
            '3Y' => now()->subYears(3),
            '5Y' => now()->subYears(5),
            default => now()->subYear(),
        };

        return Cache::remember("chart.{$equity->id}.{$period}", now()->addHours(1), function() use ($equity, $period, $dateLimit) {
            $chartData = $equity->charts()->where('date', '>=', $dateLimit)
                ->orderBy('date', 'asc')
                ->get();

            return $period === '3Y' || $period === '5Y' ? $chartData->nth(3) : $chartData;
        });
    }
}
