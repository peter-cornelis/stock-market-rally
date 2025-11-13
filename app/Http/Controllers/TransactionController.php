<?php

namespace App\Http\Controllers;

use App\Models\Equity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class TransactionController extends Controller
{
    public function create(Equity $equity, Request $request)
    {
        $type = $request->query('type', 'buy');

        return view('transactions.create', compact('equity', 'type'));
    }

    public function store(Equity $equity)
    {
        $attributes = request()->validate([
            'quantity' => ['required', 'int', 'min:1'],
            [
                'quantity.required' => 'Aantal vereist.',
                'quantity.integer' => 'Aantal dient een positief natuurlijk getal te zijn.',
                'quantity.min' => 'Aantal van 1 of hoger vereist']
            ]);
        
        $quantity = $attributes['quantity'];
        $user = Auth::user();

        if($user->balance < ($quantity * $equity->current_price)) {
            throw ValidationException::withMessages([
                'quantity' => 'Saldo ontoereikend.'
            ]);
        }

        $user->equities()->syncWithoutDetaching([
            $equity->id => ['quantity' => $quantity, 'buyPrice' => $equity->current_price]]);

        return back();
    }
}
