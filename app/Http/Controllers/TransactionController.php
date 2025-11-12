<?php

namespace App\Http\Controllers;

use App\Models\Equity;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function create(Equity $equity, Request $request)
    {
        $type = $request->query('type', 'buy');

        return view('transactions.create', compact('equity', 'type'));
    }
}
