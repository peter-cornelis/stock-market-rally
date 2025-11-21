<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreRegisteredUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'min:3', 'max:100'],
            'last_name'  => ['required', 'string', 'min:3', 'max:150'],
            'username'  => ['required', 'string', 'unique:users', 'min:3', 'max:100'],
            'email'      => ['required', 'string', 'email', 'unique:users,email'],
            'password'   => ['required', 'string', Password::min(12), 'confirmed']];
    }

    public function messages(): array
    {
        return [
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
        ];
    }
}
