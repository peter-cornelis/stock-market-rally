<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Equity;
use App\Models\Exchange;
use App\Models\FinancialRatio;
use App\Services\EquityService;
use Illuminate\Database\Seeder;

class EquitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(array $symbols): void
    {       
        $eqService = app(EquityService::class);
        
        foreach($symbols as $symbol) {
            $eqService->addEquity($symbol);
        }
    }
}
