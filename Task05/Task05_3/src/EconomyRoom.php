<?php

declare(strict_types=1);

namespace App;

class EconomyRoom extends Room
{
    public function __construct()
    {
        parent::__construct(1000, "Эконом");
    }
}
