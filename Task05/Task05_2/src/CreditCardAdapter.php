<?php

declare(strict_types=1);

namespace App;

class CreditCardAdapter implements PaymentAdapterInterface
{
    private CreditCard $adaptee;

    private function __construct(CreditCard $adaptee)
    {
        $this->adaptee = $adaptee;
    }

    public static function create(CreditCard $adaptee): CreditCardAdapter
    {
        return new CreditCardAdapter($adaptee);
    }

    public function collectMoney(float $amount): string
    {
        return $this->adaptee->transfer();
    }
}
