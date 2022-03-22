<?php

declare(strict_types=1);

namespace App\Decorators;

use App\RoomInterface;

class FoodDeliveryDecorator extends Decorator
{
    public function __construct(RoomInterface $room)
    {
        parent::__construct($room);
    }

    public function getPrice(): int
    {
        return parent::getPrice() + 300;
    }

    public function getDescription(): string
    {
        return parent::getDescription() . ", доставка еды в номер";
    }
}
