<?php

declare(strict_types=1);

namespace App\Decorators;

use App\RoomInterface;

abstract class Decorator implements RoomInterface
{
    private RoomInterface $room;

    public function __construct(RoomInterface $room)
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
