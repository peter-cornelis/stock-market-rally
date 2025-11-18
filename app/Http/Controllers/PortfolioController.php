<?php

namespace App\Http\Controllers;

use App\Services\RankingService;
use Illuminate\Support\Facades\Auth;

class PortfolioController extends Controller
{
    public function __construct(private RankingService $rankingService)
    {
    }

    public function index()
    {
        $user = Auth::user();
        $ranking = $this->rankingService->getUserRanking($user->id);
        
        return view('portfolio', compact('user', 'ranking'));
    }
}
