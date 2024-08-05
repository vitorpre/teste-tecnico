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
            "number" => "required|integer",
        ];
    }

    public function messages()
    {
        return [
            'number.required' => 'Número da conta é obrigatório',
            'number.integer' => 'Número da conta só aceita números inteiros',
        ];
    }

    /**
     * Get the data to be validated from the request.
     *
     * @return array
     */
    public function validationData()
    {
        return array_merge($this->request->all(), $this->route()->parameters());
    }
}
