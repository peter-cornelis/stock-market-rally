<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Services\EquityService;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class UpdateAllEquityChartsJob implements ShouldQueue
{
    use Queueable;

    /**
     * Execute the job.
     */
    public function handle(EquityService $equityService): void
    {
        try {
            $equityService->updateAllEquityCharts();
            Cache::flush();
            Log::info('UpdateEquityChartsJob succesfully executed');
        } catch (Exception $e) {
            Log::error('UpdateEquityChartsJob failed', [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
