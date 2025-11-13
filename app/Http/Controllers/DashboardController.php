<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $equities = $user->equities()->withPivot(
            'quantity', 'buyPrice')->with([
            'company', 'exchange'
        ])->orderBy('symbol')->get();
        return view('dashboard', ['user' => $user, 'equities' => $equities]);
    }
}
