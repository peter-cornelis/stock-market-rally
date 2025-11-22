<?php

namespace Database\Seeders;

use App\Models\Chart;
use App\Models\Equity;
use App\Models\User;
use App\Services\TransactionService;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run( int $transactionsCount, TransactionService $transactionService): void
    {
        for ($i = 0; $i < $transactionsCount; $i++) {
            $limit = fake()->randomElement([1500, 2000, 2500, 3000, 3500]);
            $user = User::inRandomOrder()->where('balance', '>=', $limit)->first();
            $equity = Equity::without('charts')->inRandomOrder()->first();
            $buy_price = (float) round($equity->current_price * fake()->randomFloat(2, 0.70, 1.30), 2);
            $quantity = floor($limit / ($buy_price * 1.0025));

            $fakeChart = new Chart([
                'price' => $buy_price, 
                'date' => now()->subDays(rand(15, 90))
            ]);

            $equity->setRelation('charts', collect([$fakeChart]));

            try {
                $transactionService->addTransaction($user, $equity, $quantity, 'buy');
            } catch (\Throwable $e) {
                continue;
            }finally {
                $equity->unsetRelation('charts');
            }
            
        }
    }
}

