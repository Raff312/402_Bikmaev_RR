<?php

declare(strict_types=1);

namespace App;

class StandardRoom extends Room
{
    public function __construct()
    {
        parent::__construct(2000, "Стандарт");
    }
}
