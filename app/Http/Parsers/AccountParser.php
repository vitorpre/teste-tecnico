<?php

namespace App\Http\Parsers;

use App\Models\Account;
use Illuminate\Http\JsonResponse;

class AccountParser
{

    public function getResponseStore(Account $account): JsonResponse
    {
        return response()->json([
            "numero_conta" => $account->number,
            "saldo" => $account->balance,
        ], 201);
    }

    public function getResponseShow(Account $account): JsonResponse
    {
        return response()->json([
            "numero_conta" => $account->number,
            "saldo" => $account->balance,
        ], 200);
    }
}
