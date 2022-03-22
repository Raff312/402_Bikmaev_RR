<?php

declare(strict_types=1);

namespace App\Decorators;

use App\Room;

abstract class Decorator extends Room
{
    private Room $room;

    public function __construct(Room $room)
    {
        $this->room = $room;
    }

    public function getPrice(): int
    {
        return $this->room->getPrice();
    }

    public function getDescription(): string
    {
        return $this->room->getDescription();
    }
}
