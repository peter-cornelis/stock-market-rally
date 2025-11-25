<?php

namespace Database\Seeders;

use App\Models\Equity;
use App\Models\User;
use App\Services\TransactionService;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run( int $transactionsCount, TransactionService $transactionService): void
    {
        for ($i = 0; $i < $transactionsCount; $i++) {

            $limit = fake()
                ->randomElement([1500, 2000, 2500, 3000, 3500, 4000, 5000, 7500]);

            $user = User::inRandomOrder()
                ->where('balance', '>=', $limit)->first();

            $equity = Equity::inRandomOrder()
                ->with([
                    'charts' => fn($query) => $query
                        ->whereDate('date', '>=', now()->startOfYear())
                        ->inRandomOrder()
                        ->limit(1)
                ])->first();

            $quantity = floor($limit / ($equity->current_price * 1.0025));

            $executedAt = $equity->charts->first()->date;


            try {
                $transactionService->addTransaction($user, $equity, $quantity, 'buy', $executedAt);
            } catch (\Throwable $e) {
                continue;
            }
        }
    }
}

