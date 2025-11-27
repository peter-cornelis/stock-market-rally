<?php

namespace App\Http\Controllers;

use App\Jobs\UpdateAllEquityChartsJob;
use App\Jobs\UpdateRankingListJob;

class CronController extends Controller
{
    public function __construct()
    {
        abort_unless(request('key') === config('app.cron_key'), 403);
    }

    public function updateCharts(): string
    {
        UpdateAllEquityChartsJob::dispatchSync();
        return 'OK';
    }

    public function updateRanking(): string
    {
        UpdateRankingListJob::dispatchSync();
        return 'OK';
    }
}
