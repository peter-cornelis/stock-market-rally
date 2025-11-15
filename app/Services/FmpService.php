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
        
        if(!$response->successful()) {
            throw ValidationException::withMessages([
                'symbol' => "Aandeel {$symbol} niet gevonden of API fout."
            ]);
        }

        if (empty($response->json())) {
            throw ValidationException::withMessages([
                'symbol' => "Geen bedrijfsgegevens gevonden voor {$symbol}."
            ]);
        }

        return $response->json();
    }

    public function getFinancialRatios(string $symbol): array
    {
        $response = Http::get("{$this->baseUrl}/ratios", [
            'symbol' => $symbol,
            'apikey' => $this->apiKey
        ]);

        if(!$response->successful()) {
            throw ValidationException::withMessages([
                'symbol' => "Aandeel {$symbol} niet gevonden of API fout."
            ]);
        }

        if (empty($response->json())) {
            throw ValidationException::withMessages([
                'symbol' => "Geen financiële gegevens gevonden voor {$symbol}."
            ]);
        }

        return $response->json()[0];
    }
}
