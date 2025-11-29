<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class ChartService
{
    public function latestTwo($query): HasMany
    {
        return $query->latest('date')->limit(2);
    }

    public function period($query, string $period): HasMany
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

        return $query->where('date', '>=', $dateLimit)
                     ->orderBy('date', 'asc');
    }

    public function periodWithMinMax($query, string $period): array
    {
        $chartData = $this->period($query, $period)->get();

        $prices = $chartData->pluck('price');
        $minPrice = $prices->min();
        $maxPrice = $prices->max();
        $minIndex = $prices->search($minPrice);
        $maxIndex = $prices->search($maxPrice);

        return [
            'charts' => $chartData,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
            'minIndex' => $minIndex,
            'maxIndex' => $maxIndex,
        ];
    }
}
