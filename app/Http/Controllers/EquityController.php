<?php

namespace App\Http\Controllers;

use App\Models\Equity;
use App\Services\ChartService;
use App\Services\EquityService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class EquityController extends Controller
{
    public function __construct(private ChartService $chartService, private EquityService $equityService)
    {
    }

    public function index()
    {
        $equities = $this->equityService->getAll()->paginate(5);
        
        return view('equities.index', ['equities' => $equities]);
    }

    public function show(Equity $equity, Request $request)
    {
        $period = $request->get('period', '1Y');

        $equity = $this->equityService->getWithSelectedChartPeriod($equity, $period);

        return view('equities.show', ['equity' => $equity, 'currentPeriod' => $period]);
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
        
        $equities = $this->equityService->getByCompanyName($request['searchQuery'])->paginate(5);
        
        return view('equities.index', ['equities' => $equities]);
    }

    public function create()
    {
        if (!Auth::user()->admin) abort(403);
        return view('equities.create');
    }

    public function store()
    {
        if (!Auth::user()->admin) abort(403);

        $validated = request()->validate([
            'symbol' => ['required', 'string', 'min:2', 'max:10']
        ],[
            'symbol.required' => 'Symbool vereist.',
            'symbol.min' => 'Minstens 2 karakters vereist.',
            'symbol.max' => 'Maximaal 10 karakters toegestaan.'
        ]);

        $result = $this->equityService->addEquity($validated['symbol']);

        return back()->with($result['type'], $result['msg']);
    }
}
