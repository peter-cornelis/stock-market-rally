<?php

namespace App\Services;

use App\Models\Company;
use App\Models\Equity;
use App\Models\Exchange;
use App\Models\FinancialRatio;

class ObjectBuilder
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
    }

    public function exchange(array $exchangeData): Exchange
    {
        return Exchange::firstOrCreate(
            ['code' => $exchangeData['exchange']],
            [
                'name' => $exchangeData['exchangeFullName'],
                'currency' => $exchangeData['currency']
            ]
        );
    }

    public function company(array $companyData, int $exchangeId): Company
    {
        $company = Company::updateOrCreate(
            ['name' => $companyData['companyName']],
            [
                'website' => $companyData['website'],
                'sector' => $companyData['sector'] ,
                'industry' => $companyData['industry'],
                'country' => $companyData['country'],
                'image' => $companyData['image'],
            ]
        );

        if (!$company->exchanges->contains($exchangeId)) {
            $company->exchanges()->attach($exchangeId);
        }

        return $company;
    }

    public function equity(array $equityData, int $companyId, int $exchangeId): Equity
    {
        return Equity::updateOrCreate(
            ['symbol' => $equityData['symbol']],
            [
                'isin' => $equityData['isin'],
                'company_id' => $companyId,
                'exchange_id' => $exchangeId,
                'lastDividend' => $equityData['lastDividend'] ?? 0
            ]
        );
    }

    public function financialRatio(int $equityId, string $beta, array $FinancialRatios)
    {
        FinancialRatio::updateOrCreate(
            ['equity_id' => $equityId],
            [
                'date' => $FinancialRatios['date'],
                'beta' => $beta,
                'priceToEarningsRatio' => $FinancialRatios['priceToEarningsRatio'],
                'priceToBookRatio' => $FinancialRatios['priceToBookRatio'],
                'dividendYieldPercentage' => $FinancialRatios['dividendYieldPercentage'],
                'currentRatio' => $FinancialRatios['currentRatio'],
                'revenuePerShare' => $FinancialRatios['revenuePerShare']
            ]
        );
    }

    public function charts(Equity $equity, array $historicalPrices): void
    {
        foreach ($historicalPrices as $item) {
            $equity->charts()->firstOrCreate(
                ['date' => $item['date']],
                [
                    'price' => $item['price'],
                    'volume' => $item['volume']
                ]
            );
        }

        $equity->charts()
            ->where('date', '<', now()->subYears(5))
            ->delete();
    }
}
