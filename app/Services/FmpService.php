<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

class FmpService
{
    private string $apiKey;
    private string $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.fmp.key');
        $this->baseUrl = config('services.fmp.base_url');
    }

    public function getCompanyProfile(string $symbol): array
    {
        $response = Http::get("{$this->baseUrl}/profile", [
            'symbol' => $symbol,
            'apikey' => $this->apiKey
        ]);
        
        if(!$response->successful() || empty($response->json())) {
            throw ValidationException::withMessages([
                'symbol' => "Geen bedrijfsgegevens voor {$symbol} beschikbaar of API fout."
            ]);
        }

        return $response->json()[0];
    }

    public function getFinancialRatios(string $symbol): array
    {
        $response = Http::get("{$this->baseUrl}/ratios", [
            'symbol' => $symbol,
            'apikey' => $this->apiKey
        ]);

        if(!$response->successful() || empty($response->json())) {
            throw ValidationException::withMessages([
                'symbol' => "Geen financiele ratios voor {$symbol} beschikbaar of API fout."
            ]);
        }

        return $response->json()[0];
    }

    public function getHistoricalPrices(string $symbol, ?string $from = null): array
    {
        $response = Http::get("{$this->baseUrl}/historical-price-eod/light", [
            'symbol' => $symbol,
            'from' => $from ?? now()->subYears(5)->format('Y-m-d'),
            'to' => now()->format('Y-m-d'),
            'apikey' => $this->apiKey
        ]);

        if(!$response->successful() || empty($response->json())) {
            throw ValidationException::withMessages([
                'symbol' => "Geen historische data voor {$symbol} beschikbaar of API fout."
            ]);
        }

        return $response->json();
    }
}
