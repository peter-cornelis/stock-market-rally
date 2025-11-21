<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Models\Equity;
use App\Models\User;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function __construct(private TransactionService $transactionService)
    {
    }

    public function index(User $user)
    {
        $username = $user->username;
        $transactionList = $this->transactionService->getUserTransactionList($user);
        return view('transactions.index', ['transactionList' => $transactionList, 'username' => $username]);
    }

    public function create(Equity $equity, Request $request)
    {
        $type = $request->query('type', 'buy');

        return view('transactions.create', ['equity' => $equity, 'type' => $type]);
    }

    public function store(Equity $equity, StoreTransactionRequest $request)
    {
        $attributes = $request->validate();
        
        $quantity = (int) $attributes['quantity'];
        $type = (string) $attributes['type'];
        $user = Auth::user();

        $result = $this->transactionService->addTransaction($user, $equity, $quantity, $type);

        return back()->with($result['type'], $result['msg']);
    } 
}
