<?php

declare(strict_types=1);

namespace App;

class PayPal
{
    private string $email;
    private string $password;

    private function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public static function create(string $email, string $password): PayPal
    {
        return new PayPal($email, $password);
    }

    public function authorizeTransaction(): string
    {
        return "PayPal Success!";
    }
}
