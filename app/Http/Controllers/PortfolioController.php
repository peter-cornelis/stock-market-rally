<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class PortfolioController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $user = Auth::user();
        $sorted = $user->equities->sortByDesc('value')->values();

        $page = request()->input('page', 1);
        $perPage = 9;
        $paginator = new LengthAwarePaginator(
            $sorted->forPage($page, $perPage),
            $sorted->count(),
            $perPage,
            $page,
            ['path' => request()->url()]
        );

        return view('portfolio', ['user' => $user, 'equitiesPaginator' => $paginator]);
    }
}
