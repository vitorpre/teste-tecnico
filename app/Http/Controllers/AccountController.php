<?php

namespace App\Http\Controllers;

use App\Http\Parsers\AccountParser;
use App\Http\Requests\Account\AccountShowRequest;
use App\Http\Requests\Account\AccountStoreRequest;
use App\Models\Account;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AccountController extends Controller
{
    protected AccountParser $parser;
    public function __construct(AccountParser $parser)
    {
        $this->parser = $parser;
    }

    public function store(AccountStoreRequest $request):JsonResponse
    {
        try{
            $account = Account::create($request->input("numero_conta"), $request->input("saldo"));
        } catch (\Exception $e) {
            return response()->json(["message" => "Não foi possível criar a conta"], 500);
        }

        return $this->parser->getResponseStore($account);

    }

    public function show(AccountShowRequest $request, string $number):JsonResponse
    {

        $account = Account::getAccountByNumber($number);

        if(!$account) {
            return response()->json(["message" => "Conta não encontrada"], 404);
        }

        return $this->parser->getResponseShow($account);
    }
}
