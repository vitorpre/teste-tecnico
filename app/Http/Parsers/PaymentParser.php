<?php

namespace App\Http\Parsers;

use App\Models\Account;
use Illuminate\Http\JsonResponse;

class PaymentParser
{

    public function getResponseStore(Account $account): JsonResponse
    {
        return response()->json([
            "numero_conta" => $account->number,
            "saldo" => number_format($account->balance, 2),
        ], 201);
    }
}
