<?php

namespace App\Http\Controllers;

use App\Services\RankingService;
use Illuminate\Http\Request;

class RankingController extends Controller
{
    public function __construct(private RankingService $rankingService)
    {
    }

    public function index()
    {
        $rankings = $this->rankingService->getRankingList();

        return view('ranking', ['rankings' => $rankings]);
    }

    public function search(Request $request)
    {
        $request->validate([
            'searchQuery' => ['required', 'string', 'min:2']
        ],[
            'searchQuery.required' => 'Symbool vereist.',
            'searchQuery.string' => 'Onbekende invoer',
            'searchQuery.min' => 'Minstens 2 karakters vereist.',
        ]);

        $rankings = $this->rankingService->getRankingListByUsername($request['searchQuery']);
        
        return view('ranking', ['rankings' => $rankings]);
    }
}
