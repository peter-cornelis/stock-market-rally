<?php

namespace App\Http\Controllers;

use App\Models\Equity;

class EquityController extends Controller
{
    public function index()
    {
        $equities = Equity::with([
            'company', 
            'exchange'
        ])->orderBy('symbol')->get();
        return view('equities.index', ['equities' => $equities]);
    }

    public function show(Equity $equity)
    {
        $equity->load(['company', 'exchange', 'financialRatio', 'charts']);
                
        return view('equities.show', ['equity' => $equity]);
    }
}
