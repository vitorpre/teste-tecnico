<?php

namespace App\Interfaces;

interface PaymentInterface
{
    function calculateFee(): string;
}
