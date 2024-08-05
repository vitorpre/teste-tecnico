<?php

namespace App\Models;

use App\Http\Factorys\PaymentFactory;
use App\Interfaces\PaymentInterface;
use Illuminate\Database\Eloquent\Model;

abstract class Payment extends Model implements PaymentInterface
{
    protected $table = "payments";
    protected $fillable = [
        'account_number',
        'account_id',
        'payment_method',
        'base_value',
        'fee_value',
        'value'
    ];
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->fee_value = $this->calculateFee();
        $this->value = bcadd($this->base_value, $this->fee_value, 2);
    }

    public function calculateFee(): string
    {
        return 0;
    }

}
