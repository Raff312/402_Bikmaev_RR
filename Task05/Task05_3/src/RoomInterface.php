<?php

declare(strict_types=1);

namespace App;

interface RoomInterface
{
    public function getPrice(): int;
    public function getDescription(): string;
}
