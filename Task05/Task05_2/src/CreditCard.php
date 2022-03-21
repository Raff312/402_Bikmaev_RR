<?php

declare(strict_types=1);

namespace App;

class CreditCard
{
    private string $cardNumber;
    private string $endDate;

    private function __construct(string $cardNumber, string $endDate)
    {
        $this->cardNumber = $cardNumber;
        $this->endDate = $endDate;
    }

    public static function create(string $cardNumber, string $endDate): CreditCard
    {
        return new CreditCard($cardNumber, $endDate);
    }

    public function transfer(): string
    {
        return "Authorization code:";
    }
}
