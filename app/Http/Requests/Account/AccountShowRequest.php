<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class AccountShowRequest extends FormRequest
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
            "numero_conta" => "required|integer",
        ];
    }

    public function messages()
    {
        return [
            'numero_conta.required' => 'Número da conta é obrigatório',
            'numero_conta.integer' => 'Número da conta só aceita números inteiros',
        ];
    }
}
