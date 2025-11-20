<?php

namespace Database\Seeders;

use App\Models\User;
use App\Services\EquityService;
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
        /*
        $this->call([
            NvidiaSeeder::class,
        ]);
        */

        User::factory()->create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'username' => 'testopulos',
            'email' => 'test@example.com',
            'password' => 'password',
            'admin' => true
        ]);

        $eqService = app(EquityService::class);
        $symbols = ['NVDA', 'AMD', 'GOOGL', 'MSFT', 'AAPL'];
        foreach($symbols as $symbol) {
            $eqService->addEquity($symbol);
        }
    }
}
