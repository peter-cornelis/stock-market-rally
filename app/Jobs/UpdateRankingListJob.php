<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Services\RankingService;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class UpdateRankingListJob implements ShouldQueue
{
    use Queueable;

    /**
     * Execute the job.
     */
    public function handle(RankingService $rankingService): void
    {
        try {
            $rankingService->updateRankingList();

            Log::info('UpdateRankingListJob succesfully executed');
        } catch (Exception $e) {
            Log::error('UpdateRankingListJob failed', [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
