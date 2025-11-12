<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {      
        $equities = Auth::user()->equities->with([
            'company', 
            'exchange',
            'chart' => function($query) {
                $query->orderBy('date', 'desc')->limit(2);
            }
        ])->orderBy('symbol')->get();
        
        $username = Auth::user()->first_name;
        return view('dashboard', ['equities' => $equities, 'username' => $username]);
    }
}
