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

    public function lastest5Years($equity): Collection
    {
        $dateLimit = now()->subYears(5);

        return Cache::remember("chart.{$equity->id}", now()->addHours(12), function() use ($equity, $dateLimit) {
            $chartData = $equity->charts()->where('date', '>=', $dateLimit)
                ->orderBy('date', 'asc')
                ->get();

            return $chartData;
        });
    }
}
