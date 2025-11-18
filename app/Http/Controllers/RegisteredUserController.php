<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }
    
    public function store()
    {
        $attributes = request()->validate([
            'first_name' => ['required', 'string', 'min:3', 'max:100'],
            'last_name'  => ['required', 'string', 'min:3', 'max:150'],
            'username'  => ['required', 'string', 'unique:users', 'min:3', 'max:100'],
            'email'      => ['required', 'string', 'email', 'unique:users,email'],
            'password'   => ['required', 'string', Password::min(12), 'confirmed']],
            [
                'first_name.required' => 'Voornaam vereist.',
                'first_name.min' => 'Minstens 3 karakters vereist.',
                'first_name.max' => 'Maximaal 255 karakters toegestaan.',
                'last_name.required' => 'Familienaam vereist.',
                'last_name.min' => 'Minstens 3 karakters vereist.',
                'last_name.max' => 'Maximaal 255 karakters toegestaan.',
                'username.required' => 'Gebruikersnaam vereist.',
                'username.unique' => 'Dit is geen unieke gebruikersnaam.',
                'username.min' => 'Minstens 3 karakters vereist.',
                'username.max' => 'Maximaal 255 karakters toegestaan.',
                'email.required' => 'E-mailadres vereist.',
                'email.unique' => 'Dit emailadres is reeds gekoppeld aan een account.',
                'password.required' => 'Wachtwoord vereist.',
                'password.min' => 'Minstens 12 karakters vereist.',
                'password.confirmed' => 'Wachtwoorden komen niet overeen.'
        ]);

        $user = User::create($attributes);

        Auth::login($user);

        return redirect('/portfolio')->with('status', "Welkom $user->first_name");
    }
}
