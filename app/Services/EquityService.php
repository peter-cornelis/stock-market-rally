<?php

namespace App\Services;

use App\Models\Company;
use App\Models\Equity;
use Gemini\Data\Content;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\ValidationException;
use Gemini\Laravel\Facades\Gemini;
use Illuminate\Support\Facades\Cache;
use stdClass;

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

    public function getByCompanyName(string $searchQuery): ?Builder
    {
        $hasResults = Company::where('name', 'like', '%'.$searchQuery.'%')->count();
        if($hasResults == 0) {
            $searchQuery = $this->suggestCompanyName($searchQuery);
        }

        $result = Equity::query()
            ->with([
            'company', 
            'exchange',
            'charts' => fn($query) => $this->chartService->latestTwo($query)
        ])->whereHas('company', fn($query) => 
            $query->where('name', 'like', '%'.$searchQuery.'%')
        )->orderBy('symbol');

        return $result ?? null;
    }

    public function suggestCompanyName(string $searchQuery): ?string
    {
        try {
            $availableCompanies = Company::get()
            ->pluck('name');
        
            return Gemini::generativeModel(model: 'gemini-2.5-flash-lite')
                ->withSystemInstruction(
                    Content::parse('Return ONLY the correct edit if minimal (1 to 3) changes are needed, nothing else. No explanation.')
                )
                ->generateContent("User searched for: '{$searchQuery}'. Available companies: {$availableCompanies}. Search closest company.")
                ->text();
        } catch(\Exception $e) {
            return null;
        }
    }

    public function getWithFinancialRatios(Equity $equity): Equity
    {
        return $equity->load([
            'financialRatio',
            'charts' => fn($query) => $this->chartService->latestTwo($query)
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

    public function getAiAnalysis(string $symbol): ?string
    {
        try {
            return Cache::remember("aiAnalysis.{$symbol}", now()->addHours(4), function() use ($symbol) {
                $result = Gemini::generativeModel(model: 'gemini-2.5-flash-lite')
                    ->withSystemInstruction(
                        Content::parse('Always start with technical analysis suggests. Explain in min 2, max 5 sentences.')
                    )
                    ->generateContent("buy or sell advice for the moment based on techbical analysis for the equity with symbol {$symbol} in dutch. Simple explained. Use company name instead of symbol.");
                return $result->text();
            });
        } catch(\Exception $e) {
            return null;
        }
    }
}

