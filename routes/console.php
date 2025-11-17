<?php

use App\Services\EquityService;
use Illuminate\Console\Scheduling\Schedule;

Schedule::call(function () {
    app(EquityService::class)->updateAllEquityCharts();
})->dailyAt('05:00');