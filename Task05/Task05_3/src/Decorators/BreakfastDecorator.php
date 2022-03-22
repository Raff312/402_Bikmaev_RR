<?php

declare(strict_types=1);

namespace App\Decorators;

use App\RoomInterface;

class BreakfastDecorator extends Decorator
{
    public function __construct(RoomInterface $room)
    {
        parent::__construct($room);
    }

    public function getPrice(): int
    {
        return parent::getPrice() + 500;
    }

    public function getDescription(): string
    {
        return parent::getDescription() . ", завтрак \"шведский стол\"";
    }
}
