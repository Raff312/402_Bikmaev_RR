<?php

declare(strict_types=1);

namespace App\Decorators;

use App\Room;

class InternetDecorator extends Decorator
{
    public function __construct(Room $room)
    {
        parent::__construct($room);
    }

    public function getPrice(): int
    {
        return parent::getPrice() + 100;
    }

    public function getDescription(): string
    {
        return parent::getDescription() . ", выделенный Интернет";
    }
}
