<?php

declare(strict_types=1);

namespace App\Tests;

use App\CreditCard;
use App\CreditCardAdapter;
use PHPUnit\Framework\TestCase;

final class CreditCardAdapterTest extends TestCase
{
    public function testCollectMoney(): void
    {
        // arrange
        $cc = CreditCard::create("1234567890123456", "09/22");
        $ccAdapter = CreditCardAdapter::create($cc);

        // act
        $result = $ccAdapter->collectMoney(100);

        // assert
        $this->assertSame("Authorization code:", $result);
    }
}
