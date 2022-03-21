<?php

declare(strict_types=1);

namespace App\Tests;

use App\PayPal;
use App\PayPalAdapter;
use PHPUnit\Framework\TestCase;

final class PayPalAdapterTest extends TestCase
{
    public function testCollectMoney(): void
    {
        // arrange
        $paypal = PayPal::create("customer@aol.com", "password");
        $paypalAdapter = PayPalAdapter::create($paypal);

        // act
        $result = $paypalAdapter->collectMoney(100);

        // assert
        $this->assertSame("PayPal Success!", $result);
    }
}
