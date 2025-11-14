<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        //validate
        $attributes = request()->validate([
            'email' => ['required'],
            'password' => ['required']
        ]);

        //attempt to login user
        if(! Auth::attempt($attributes)) {
            throw ValidationException::withMessages([
                'email' => 'Incorrect e-mailadres of wachtwoord.'
            ]);
        }
        
        //regenerate session token
        request()->session()->regenerate();
        
        //Get User
        $username = Auth::user()->first_name;

        //redirect
        return redirect('/portfolio')->with('status', "Welkom $username");
    }

    public function destroy()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/');
    }
}


