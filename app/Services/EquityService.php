<?php

namespace App\Services;

use App\Models\Equity;
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

        $profileData = $this->fmpService->getCompanyProfile($symbol);
        $ratiosData = $this->fmpService->getFinancialRatios($symbol);
        $historicalPrices = $this->fmpService->getHistoricalPrices($symbol);
        dd($historicalPrices);
    }
}
