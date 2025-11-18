<?php

use App\Services\EquityService;
use App\Services\RankingService;
use Illuminate\Support\Facades\Schedule;

Schedule::call(function () {
    app(EquityService::class)->updateAllEquityCharts();
})->dailyAt('05:00');

Schedule::call(function () {
    app(RankingService::class)->updateRankingList();
})->hourly();