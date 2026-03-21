<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\StatisticService;

class StatisticController extends Controller
{
    public function __construct(private readonly StatisticService $statisticService) {}

    public function index()
    {
        $statistics = $this->statisticService->getAll();

        return view('home', ['statistics' => $statistics]);
    }
}
