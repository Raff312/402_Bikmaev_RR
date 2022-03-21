<?php

declare(strict_types=1);

namespace App;

interface PaymentAdapterInterface
{
    public function collectMoney(float $amount): string;
}
