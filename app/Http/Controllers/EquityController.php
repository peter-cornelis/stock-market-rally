<?php

namespace App\Http\Controllers;

use App\Models\Equity;
use App\Models\Transaction;
use App\Models\User;
use App\Services\ChartService;
use App\Services\EquityService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class EquityController extends Controller
{
    public function __construct(private ChartService $chartService, private EquityService $equityService)
    {
    }

    public function home()
    {
        $totalTransactions = Transaction::whereYear('executed_at', now()->year)
            ->count();
        $activeUsers = Transaction::whereYear('executed_at', now()->year)
            ->distinct('user_id')
            ->count('user_id');
        $firstUser = User::query()
            ->with(['equities.charts' => fn($q) => $q->latest('date')->limit(2)])
            ->where('ranking', 1)
            ->first();
        return view('home', compact('totalTransactions', 'activeUsers', 'firstUser'));
    }

    public function index()
    {
        $equities = Equity::with([
            'company', 
            'exchange',
            'charts' => fn($query) => $this->chartService->latestTwo($query)
        ])->orderBy('symbol')->paginate(5);
        
        return view('equities.index', ['equities' => $equities]);
    }

    public function show(Equity $equity, Request $request)
    {
        $period = $request->get('period', '1Y');

        $equity->load([
            'financialRatio',
            'charts' => fn($query) => $this->chartService->period($query, $period)
        ]);

        return view('equities.show', ['equity' => $equity, 'currentPeriod' => $period]);
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
