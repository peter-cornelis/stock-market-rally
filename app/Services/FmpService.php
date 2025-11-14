<?php

namespace App\Services;

class FmpService
{
    private string $apiKey;
    private string $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.fmp.key');
        $this->baseUrl = config('services.fmp.base_url');
    }
}
