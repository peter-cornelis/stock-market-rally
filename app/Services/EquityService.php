<?php

namespace App\Services;

use App\Models\Chart;
use App\Models\Company;
use App\Models\Equity;
use App\Models\Exchange;
use App\Models\FinancialRatio;
use Illuminate\Validation\ValidationException;

class EquityService
{
    /**
     * Create a new class instance.
     */
    public function __construct(private FmpService $fmpService)
    {
    }

    public function addEquity(string $symbol)
    {
        if (Equity::where('symbol', $symbol)->first()) {
            throw ValidationException::withMessages([
                'symbol' => 'Aandeel reeds aanwezig.'
            ]);
        }

        $profile = $this->fmpService->getCompanyProfile($symbol);
        $FinancialRatios = $this->fmpService->getFinancialRatios($symbol);
        $historicalPrices = $this->fmpService->getHistoricalPrices($symbol);

        $exchange = Exchange::updateOrCreate(
            ['code' => $profile['exchange']],
            [
                'name' => $profile['exchangeFullName'],
                'currency' => $profile['currency']
            ]
        );

        $company = Company::create([
            'name' => $profile['companyName'],
            'website' => $profile['website'],
            'sector' => $profile['sector'] ,
            'industry' => $profile['industry'],
            'country' => $profile['country'],
            'image' => $profile['image'],
        ]);

        $company->exchanges()->syncWithoutDetaching($exchange->id);

        $equity = Equity::create([
            'isin' => $profile['isin'],
            'symbol' => $symbol,
            'company_id' => $company->id,
            'exchange_id' => $exchange->id,
            'lastDividend' => $profile['lastDiv'] ?? 0
        ]);

        FinancialRatio::create([
            'equity_id' => $equity->id,
            'date' => $FinancialRatios['date'],
            'beta' => $profile['beta'],
            'priceToEarningsRatio' => $FinancialRatios['priceToEarningsRatio'],
            'priceToBookRatio' => $FinancialRatios['priceToBookRatio'],
            'dividendYieldPercentage' => $FinancialRatios['dividendYieldPercentage'],
            'currentRatio' => $FinancialRatios['currentRatio'],
            'revenuePerShare' => $FinancialRatios['revenuePerShare'],
        ]);

        $equity->charts()->createMany(
            collect($historicalPrices)
                ->map(fn($item) => [
                    'date' => $item['date'],
                    'price' => $item['price'],
                    'volume' => $item['volume'],
                ])
                ->toArray()
        );
    }
}
