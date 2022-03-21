<?php

declare(strict_types=1);

namespace App;

class PayPalAdapter implements PaymentAdapterInterface
{
    private PayPal $adaptee;

    private function __construct(PayPal $adaptee)
    {
        $this->adaptee = $adaptee;
    }

    public static function create(PayPal $adaptee): PayPalAdapter
    {
        return new PayPalAdapter($adaptee);
    }

    public function collectMoney(float $amount): string
    {
        return $this->adaptee->authorizeTransaction();
    }
}
