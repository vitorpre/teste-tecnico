<?php

namespace App\Models;

use App\Interfaces\PaymentInterface;
use Illuminate\Database\Eloquent\Model;

class CreditPayment extends Payment implements PaymentInterface
{
    private static float $FEE_PERCENT = 5;

    public function calculateFee(): string
    {
        return  bcmul($this->base_value, bcdiv(self::$FEE_PERCENT, 100, 2), 2);
    }


}
