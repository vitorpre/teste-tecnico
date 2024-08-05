<?php

namespace App\Http\Requests\Payment;

use Illuminate\Foundation\Http\FormRequest;

class PaymentStoreRequest extends FormRequest
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
            "forma_pagamento" => "required|in:D,C,P",
            "numero_conta" => "required|integer",
            "valor" => "required|min:0|numeric",
        ];
    }

    public function messages()
    {
        return [
            'numero_conta.required' => 'Número da conta é obrigatório',
            'numero_conta.integer' => 'Número da conta só aceita números inteiros',
            'forma_pagamento.required' => 'Forma de pagamento é obrigatória',
            'forma_pagamento.in' => 'Forma de pagamento deve ser D (débito),C (crédito) ou P (pix)',
            'valor.required' => 'Saldo é obrigatório',
            'valor.numeric' => 'Saldo só aceita números',
            'valor.min' => 'Saldo deve ser no minímo zero'
        ];
    }
}
