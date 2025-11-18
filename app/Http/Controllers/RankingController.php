<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\RankingService;

class RankingController extends Controller
{
    public function __construct(private RankingService $rankingService)
    {
    }

    public function index()
    {
        $rankings = $this->rankingService->getRankingList();

        return view('ranking', compact('rankings'));
    }
}
