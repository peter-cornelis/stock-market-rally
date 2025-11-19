<?php

namespace App\Http\Controllers;

use App\Services\StatisticService;

class StatisticController extends Controller
{
    public function __construct(private StatisticService $statisticService)
    {
    }

    public function index()
    {
        $statistics = $this->statisticService->getAll();
        return view('home', compact('statistics'));
    }
}
