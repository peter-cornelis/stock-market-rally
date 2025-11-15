<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Equity;
use App\Models\Exchange;
use App\Models\FinancialRatio;
use Illuminate\Database\Seeder;

class NvidiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nasExchange = Exchange::create([
            'code' => 'NASDAQ',
            'name' => 'NASDAQ Global Select',
            'currency' => 'USD'
            ]);

        $nvdaCompany = Company::create(
            [
                'name' => 'NVIDIA Corporation',
                'website' => 'https://www.nvidia.com',
                'sector' => 'Technology',
                'industry' => 'Semiconductors',
                'country' => 'US',
                'image' => 'https://images.financialmodelingprep.com/symbol/NVDA.png',
            ]
        );

        $nvdaCompany->exchanges()->attach($nasExchange->id);

        $nvdaEquity = Equity::create(
            [
                'company_id' => $nvdaCompany->id,
                'exchange_id' => $nasExchange->id,
                'isin' => 'US67066G1040',
                'symbol' => 'NVDA',
                'lastDividend' => 0.99
            ]
        );

        FinancialRatio::create([
            'equity_id' => $nvdaEquity->id,
            'date' => now(),
            'beta' => 2.269,
            'priceToEarningsRatio' => 40.25,
            'priceToBookRatio' => 25.50,
            'dividendYieldPercentage' => 0.03,
            'currentRatio' => 4.44,
            'revenuePerShare' => 5.23,
        ]);

        $data = [
            ["date" => "2025-11-06", "price" => 188.08, "volume" => 223029778],
            ["date" => "2025-11-05", "price" => 195.21, "volume" => 171350332],
            ["date" => "2025-11-04", "price" => 198.69, "volume" => 188919320],
            ["date" => "2025-11-03", "price" => 206.88, "volume" => 180267300],
            ["date" => "2025-10-31", "price" => 202.49, "volume" => 179802200]
        ];

        // Insert chart data
        foreach ($data as $item) {
            $nvdaEquity->charts()->create([
                'date' => $item['date'],
                'price' => $item['price'],
                'volume' => $item['volume']
            ]);
        }
    }
}
