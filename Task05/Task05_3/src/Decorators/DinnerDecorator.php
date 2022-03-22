<?php

declare(strict_types=1);

namespace App\Decorators;

use App\Room;

class DinnerDecorator extends Decorator
{
    public function __construct(Room $room)
    {
        parent::__construct($room);
    }

    public function getPrice(): int
    {
        return parent::getPrice() + 800;
    }

    public function getDescription(): string
    {
        return parent::getDescription() . ", ужин";
    }
}
