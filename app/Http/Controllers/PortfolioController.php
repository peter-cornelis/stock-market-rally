<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class PortfolioController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        return view('portfolio', compact('user'));
    }
}
