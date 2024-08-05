<?php

namespace App\Http\Controllers;

use App\Exceptions\NotEnoughBalanceException;
use App\Http\Factorys\PaymentFactory;
use App\Http\Parsers\PaymentParser;
use App\Http\Requests\Payment\PaymentStoreRequest;
use App\Models\Account;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    protected PaymentParser $parser;
    public function __construct(PaymentParser $parser)
    {
        $this->parser = $parser;
    }

    public function store(PaymentStoreRequest $request) {

        $account = Account::getAccountByNumber($request->input("numero_conta"));

        if(!$account) {
            return response()->json(["message" => "Conta não encontrada"], 422);
        }

        $payment = PaymentFactory::create(
            account: $account,
            paymentMethod: $request->input("forma_pagamento"),
            value: $request->input("valor")
        );

        DB::beginTransaction();

        try {
            if(!$payment->save()) {
                throw new \Exception();
            }
            $account->updateBalance(-$payment->value);

        } catch (NotEnoughBalanceException $e) {
            DB::rollBack();
            return response()->json(["message" => "Saldo insuficiente"], 404);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(["message" => "Erro ao gravar transação"], 500);
        }

        DB::commit();

        return $this->parser->getResponseStore($account);
    }
}
