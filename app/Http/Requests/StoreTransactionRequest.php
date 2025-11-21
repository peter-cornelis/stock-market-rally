<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
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
            'quantity' => ['required', 'integer', 'min:1'],
            'type' => ['required', 'in:buy,sell']
        ];
    }

    public function messages(): array
    {
        return [
            'quantity.required' => 'Aantal vereist.',
            'quantity.integer' => 'Aantal dient een positief natuurlijk getal te zijn.',
            'quantity.min' => 'Aantal van 1 of hoger vereist.',
            'type' => 'Transactietype onbekend.'
        ];
    }
}
