<?php

use App\Jobs\UpdateAllEquityChartsJob;
use App\Jobs\UpdateRankingListJob;
use Illuminate\Support\Facades\Schedule;

Schedule::job(new UpdateAllEquityChartsJob())
    ->weekdays()
    ->at('23:00');

Schedule::job(new UpdateRankingListJob())
    ->everyFiveMinutes();