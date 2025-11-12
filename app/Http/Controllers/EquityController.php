<?php

namespace App\Http\Controllers;

use App\Models\Equity;

class EquityController extends Controller
{
    public function index()
    {
        $equities = Equity::with([
            'company', 
            'exchange',
            'charts' => function($query) {
                $query->orderBy('date', 'desc')->limit(2);
            }
        ])->orderBy('symbol')->get();
        return view('equities.index', ['equities' => $equities]);
    }
}
