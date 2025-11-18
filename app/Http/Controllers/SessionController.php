<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email' => ['required'],
            'password' => ['required']
        ]);

        if(! Auth::attempt($attributes)) {
            throw ValidationException::withMessages([
                'email' => 'Incorrect e-mailadres of wachtwoord.'
            ]);
        }
        
        request()->session()->regenerate();
        
        $firstName = Auth::user()->first_name;

        return redirect('/portfolio')->with('status', "Welkom $firstName");
    }

    public function destroy()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/');
    }
}


