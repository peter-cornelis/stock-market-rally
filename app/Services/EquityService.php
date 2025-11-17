<?php

namespace App\Services;

use App\Models\Equity;
use Illuminate\Validation\ValidationException;

class EquityService
{
    /**
     * Create a new class instance.
     */
    public function __construct(private FmpService $fmpService, private ObjectBuilder $objectBuilder)
    {
    }

    public function addEquity(string $symbol): array
    {
        if (Equity::where('symbol', $symbol)->first()) {
            throw ValidationException::withMessages([
                'symbol' => 'Aandeel reeds aanwezig.'
            ]);
        }
        try {
            $profile = $this->fmpService->getCompanyProfile($symbol);
            $FinancialRatios = $this->fmpService->getFinancialRatios($symbol);
            $historicalPrices = $this->fmpService->getHistoricalPrices($symbol);

            $exchange = $this->objectBuilder->exchange($profile);
            $company = $this->objectBuilder->company($profile, $exchange->id);
            $equity = $this->objectBuilder->equity($profile, $company->id, $exchange->id);
            $this->objectBuilder->financialRatio($equity->id,$profile['beta'], $FinancialRatios);
            $this->objectBuilder->charts($equity, $historicalPrices);

            return [
                'msgType' => 'status',
                'msg' => "Aandeel $symbol, succesvol toegevoegd."
            ];

        } catch(\Exception) {
            return [
                'msgType' => 'error',
                'msg' => "Aandeel $symbol, kon niet worden toegevoegd."
            ];
        }
    }
}
