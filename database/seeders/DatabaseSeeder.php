<?php

namespace Database\Seeders;

use App\Models\Equity;
use App\Models\User;
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
        $this->call([
            NvidiaSeeder::class,
        ]);

        $user = User::factory()->create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'test@example.com',
            'password' => 'password'
        ]);

        $user->equities()->attach(1, [
            'quantity' => 10,
            'buyPrice' => 150.50
        ]);

    }
}
