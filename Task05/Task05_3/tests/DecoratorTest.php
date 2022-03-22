<?php

declare(strict_types=1);

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\EconomyRoom;
use App\StandardRoom;
use App\SuiteRoom;
use App\Decorators\InternetDecorator;
use App\Decorators\BreakfastDecorator;
use App\Decorators\FoodDeliveryDecorator;
use App\Decorators\SofaDecorator;

final class DecoratorTest extends TestCase
{
    public function testEconomyRoomGetPrice(): void
    {
        // arrange
        $room = new EconomyRoom();
        $room = new InternetDecorator($room);
        $room = new BreakfastDecorator($room);

        // act
        $roomPrice = $room->getPrice();

        // assert
        $this->assertSame(1600, $roomPrice);
    }

    public function testStandardRoomGetPrice(): void
    {
        // arrange
        $room = new StandardRoom();
        $room = new InternetDecorator($room);
        $room = new BreakfastDecorator($room);
        $room = new SofaDecorator($room);

        // act
        $roomPrice = $room->getPrice();

        // assert
        $this->assertSame(3100, $roomPrice);
    }

    public function testSuiteRoomGetPrice(): void
    {
        // arrange
        $room = new SuiteRoom();
        $room = new FoodDeliveryDecorator($room);

        // act
        $roomPrice = $room->getPrice();

        // assert
        $this->assertSame(3300, $roomPrice);
    }

    public function testEconomyRoomGetDescription(): void
    {
        // arrange
        $room = new EconomyRoom();
        $room = new InternetDecorator($room);
        $room = new BreakfastDecorator($room);

        // act
        $roomDescription = $room->getDescription();

        // assert
        $this->assertSame("Номер: Эконом, выделенный Интернет, завтрак \"шведский стол\"", $roomDescription);
    }

    public function testStandardRoomGetDescription(): void
    {
        // arrange
        $room = new StandardRoom();
        $room = new InternetDecorator($room);
        $room = new BreakfastDecorator($room);
        $room = new SofaDecorator($room);

        // act
        $roomDescription = $room->getDescription();

        // assert
        $this->assertSame(
            "Номер: Стандарт, выделенный Интернет, завтрак \"шведский стол\", дополнительный диван",
            $roomDescription
        );
    }

    public function testSuiteRoomGetDescription(): void
    {
        // arrange
        $room = new SuiteRoom();
        $room = new FoodDeliveryDecorator($room);

        // act
        $roomDescription = $room->getDescription();

        // assert
        $this->assertSame("Номер: Люкс, доставка еды в номер", $roomDescription);
    }
}
