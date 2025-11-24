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
            'username' => 'testopulos',
            'email' => 'test@example.com',
            'password' => 'password',
            'admin' => true
        ]);

        User::factory()->count(100)->create();

        $symbols = [
            //'NVDA', 'AMD', 'GOOGL', 'MSFT', 'AAPL', 
            'AMZN', //'META', //'SHOP', 'PLTR', 'INTC',
        ];

        // 'SNAP', 'SQ', 'NFLX', 'ADBE', 'ROKU'
        
        $this->callWith(EquitySeeder::class, ['symbols' => $symbols]);
        
        $this->callWith(TransactionSeeder::class, ['transactionsCount' => 250]);
        
        (new RankingService())->updateRankingList();
    }
}
