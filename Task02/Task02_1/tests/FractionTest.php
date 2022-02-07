<?php

declare(strict_types=1);

namespace App;

use PHPUnit\Framework\TestCase;
use Exception;
use App\Fraction;

final class FractionTest extends TestCase
{
    public function testCreateWithAllPositiveArgs(): void
    {
        // act
        $frac1 = Fraction::create(34, 116);
        $frac2 = Fraction::create(343, 54);

        //assert
        $this->assertEquals("17/58", $frac1->__toString());
        $this->assertEquals("6'19/54", $frac2->__toString());
    }

    public function testCreateWithOnePositiveArg(): void
    {
        // act
        $frac1 = Fraction::create(34, -116);
        $frac2 = Fraction::create(-34, 116);

        // assert
        $this->assertEquals("-17/58", $frac1->__toString());
        $this->assertEquals("-17/58", $frac2->__toString());
    }

    public function testCreateWithAllNegativeArgs(): void
    {
        // act
        $frac = Fraction::create(-34, -116);

        // assert
        $this->assertEquals("17/58", $frac->__toString());
    }

    public function testCreateWithDivisibleArguments(): void
    {
        // act
        $frac1 = Fraction::create(10, 5);
        $frac2 = Fraction::create(5, 5);

        //assert
        $this->assertEquals("2", $frac1->__toString());
        $this->assertEquals("1", $frac2->__toString());
    }

    public function testCreateWithZeroNumerator(): void
    {
        // act
        $frac = Fraction::create(0, -116);

        //assert
        $this->assertEquals("0", $frac->__toString());
    }

    public function testCreateWithZeroDenominator(): void
    {
        // assert
        $this->expectException(Exception::class);
        $this->expectErrorMessage("denominator can't be 0");

        // act
        Fraction::create(343, 0);
    }

    public function testGetNumerator(): void
    {
        // arrange
        $frac = Fraction::create(595, 721);

        // act
        $numer = $frac->getNumer();

        // assert
        $this->assertSame(85, $numer);
    }

    public function testGetDenominator(): void
    {
        // arrange
        $frac = Fraction::create(595, 721);

        // act
        $denom = $frac->getDenom();

        // assert
        $this->assertSame(103, $denom);
    }

    public function testAdd(): void
    {
        // arrange
        $frac1 = Fraction::create(34, 116);
        $frac2 = Fraction::create(343, 54);

        // act
        $actualResult = $frac1->add($frac2);

        // assert
        $expectedResult = Fraction::create(5203, 783);
        $this->assertEquals($expectedResult, $actualResult);
    }

    public function testSub(): void
    {
        // arrange
        $frac1 = Fraction::create(34, 116);
        $frac2 = Fraction::create(343, 54);

        // act
        $actualResult = $frac1->sub($frac2);

        // assert
        $expectedResult = Fraction::create(-4744, 783);
        $this->assertEquals($expectedResult, $actualResult);
    }
}
