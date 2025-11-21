<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRankingRequest;
use App\Services\RankingService;

class RankingController extends Controller
{
    public function __construct(private RankingService $rankingService)
    {
    }

    public function index()
    {
        $rankings = $this->rankingService
            ->getRankingList();

        return view('ranking', ['rankings' => $rankings]);
    }

    public function search(SearchRankingRequest $request)
    {
        $attributes =$request->validated();

        $rankings = $this->rankingService
            ->getRankingListByUsername($attributes['searchQuery']);
        
        return view('ranking', ['rankings' => $rankings]);
    }
}
