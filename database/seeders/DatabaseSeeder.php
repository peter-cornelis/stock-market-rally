<?php

namespace Database\Seeders;

use App\Models\User;
use App\Services\RankingService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'username' => env('ADMIN_NAME'),
            'email' => env('ADMIN_EMAIL'),
            'password' => env('ADMIN_PASSWORD'),
            'admin' => true,
        ]);

        User::factory()->count(50)->create();

        $symbols = [
            'NVDA', 'AMD', 'GOOGL', 'MSFT', 'AAPL',
            'AMZN', 'META', 'SHOP', 'PLTR', 'INTC',
            'PYPL', 'PINS', 'NFLX', 'ADBE', 'DIS',
        ];

        $this->callWith(EquitySeeder::class, ['symbols' => $symbols]);

        $this->callWith(TransactionSeeder::class, ['transactionsCount' => 400]);

        (new RankingService)->updateRankingList();
    }
}
