<?php

namespace App\Models;

use App\Interfaces\PaymentInterface;
use Illuminate\Database\Eloquent\Model;

class PixPayment extends Payment implements PaymentInterface
{
    public function calculateFee(): string
    {
        return 0;
    }
}
