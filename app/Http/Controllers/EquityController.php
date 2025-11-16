<?php

namespace App\Http\Controllers;

use App\Models\Equity;
use App\Services\EquityService;
use Illuminate\Support\Facades\Auth;

class EquityController extends Controller
{
    public function __construct(private EquityService $equityService)
    {
    }

    public function index()
    {
        $equities = Equity::with([
            'company', 
            'exchange',
            'charts' => fn($query) => $query->latest('date')->limit(2)
        ])->orderBy('symbol')->get();
        
        return view('equities.index', ['equities' => $equities]);
    }

    public function show(Equity $equity)
    {
        $equity->load(['company', 'exchange', 'financialRatio', 'charts']);
                
        return view('equities.show', ['equity' => $equity]);
    }

    public function create()
    {
        if (!Auth::user()->admin) abort(403);
        return view('equities.create');
    }

    public function store()
    {
        $validated = request()->validate([
            'symbol' => ['required', 'string', 'min:2', 'max:10']
        ],[
            'symbol.required' => 'Symbool vereist.',
            'symbol.min' => 'Minstens 2 karakters vereist.',
            'symbol.max' => 'Maximaal 10 karakters toegestaan.'
        ]);

        $this->equityService->addEquity($validated['symbol']);

        return back();
    }

}
