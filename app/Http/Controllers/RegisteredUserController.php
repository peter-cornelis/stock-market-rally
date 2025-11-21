<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegisteredUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }
    
    public function store(StoreRegisteredUserRequest $request)
    {
        $attributes = $request->validated();

        $user = User::create($attributes);

        Auth::login($user);

        return redirect('/portfolio')
            ->with('status', "Welkom $user->first_name");
    }
}
