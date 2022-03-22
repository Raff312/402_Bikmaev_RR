<?php

declare(strict_types=1);

namespace App;

abstract class Room implements RoomInterface
{
    protected int $price;
    protected string $description;

    protected function __construct(int $price, string $description)
    {
        $this->price = $price;
        $this->description = $description;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getDescription(): string
    {
        return "Номер: " . $this->description;
    }
}
