<?php

namespace App\Services;

use App\Models\Equity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\ValidationException;

class EquityService
{
    /**
     * Create a new class instance.
     */
    public function __construct(private FmpService $fmpService, private ObjectBuilder $objectBuilder, private ChartService $chartService)
    {
    }

    public function getAll(): Builder
    {
        return Equity::with([
            'company', 
            'exchange',
            'charts' => fn($query) => $this->chartService->latestTwo($query)
        ])->orderBy('symbol');
    }

    public function getByCompanyName(string $searchQuery): Builder
    {
       return Equity::query()
            ->with([
            'company', 
            'exchange',
            'charts' => fn($query) => $this->chartService->latestTwo($query)
        ])->whereHas('company', function($query) use ($searchQuery) {
            $query->where('name', 'like', '%'.$searchQuery.'%');
        })->orderBy('symbol');
    }

    public function getWithSelectedChartPeriod(Equity $equity, string $period): Equity
    {
        return $equity->load([
            'financialRatio',
            'charts' => fn($query) => $this->chartService->period($query, $period)
        ]);
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

            return ['type' => 'status', 'msg' =>"Aandeel $symbol, succesvol toegevoegd."];

        } catch(ValidationException $e) {
            throw $e;
        } catch(\Exception $e) {
            return ['type' => 'error', 'msg' =>"Aandeel $symbol, kon niet worden toegevoegd."];
        }
    }

    public function updateAllEquityCharts(): void
    {
        $equities = Equity::all();

        foreach ($equities as $equity) {
            $latestDate = $equity->charts()->max('date');
            $newPrices = $this->fmpService->getHistoricalPrices($equity->symbol, $latestDate);
            $this->objectBuilder->charts($equity, $newPrices);
        }
    }
}
