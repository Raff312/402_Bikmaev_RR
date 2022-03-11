<?php

declare(strict_types=1);

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Truncater;

final class TruncaterTest extends TestCase
{
    public function testTruncate(): void
    {
        // arrange
        $truncater1 = Truncater::create();
        $truncater2 = Truncater::create(['length' => 6]);

        // act
        $res1 = $truncater1->truncate("Lorem Ipsum is simply dummy text of the printing and typesetting", ['length' => 3]);
        $res2 = $truncater1->truncate("Lorem Ipsum is simply dummy text of the printing and typesetting");
        $res3 = $truncater2->truncate("Lorem Ipsum is simply dummy text of the printing and typesetting", ['length' => 10,'separator' => ',,,']);
        $res4 = $truncater2->truncate("Lorem Ipsum is simply dummy text of the printing and typesetting");

        // assert
        $this->assertSame("Lor...", $res1);
        $this->assertSame("Lorem Ipsum is simply dummy text of the printing and typesetting", $res2);
        $this->assertSame("Lorem Ipsu,,,", $res3);
        $this->assertSame("Lorem ...", $res4);
    }
}
