<?php

use App\Services\EquityService;
use Illuminate\Support\Facades\Schedule;

Schedule::call(function () {
    app(EquityService::class)->updateAllEquityCharts();
})->dailyAt('05:00');