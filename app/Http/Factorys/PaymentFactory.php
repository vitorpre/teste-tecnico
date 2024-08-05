<?php

namespace App\Http\Factorys;

use App\Interfaces\PaymentInterface;
use App\Models\Account;
use App\Models\CreditPayment;
use App\Models\DebitPayment;
use App\Models\PixPayment;

class PaymentFactory
{
    public static string $METHOD_PIX = "P";
    public static string $METHOD_CREDIT = "C";
    public static string $METHOD_DEBIT = "D";


    public static function create(Account $account, string $paymentMethod, float $value): PaymentInterface
    {
        $attributes = [
            "account_number" => $account->number,
            "account_id" => $account->id,
            "payment_method" => $paymentMethod,
            "base_value" => $value,
        ];

        switch ($paymentMethod) {
            case self::$METHOD_DEBIT:
                return new DebitPayment($attributes);
            case self::$METHOD_CREDIT:
                return new CreditPayment($attributes);
            case self::$METHOD_PIX:
                return new PixPayment($attributes);
            default:
                throw new \InvalidArgumentException("Forma de pagamento inválida: $paymentMethod");
        }
    }
}
