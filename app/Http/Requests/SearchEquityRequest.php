<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchEquityRequest extends FormRequest
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
            'searchQuery' => ['required', 'string', 'min:2']
        ];
    }

    public function messages(): array
    {
        return [
            'searchQuery.required' => 'Symbool vereist.',
            'searchQuery.string' => 'Onbekende invoer',
            'searchQuery.min' => 'Minstens 2 karakters vereist.'
        ];
    }
}
