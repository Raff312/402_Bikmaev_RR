<?php

declare(strict_types=1);

namespace App;

class SuiteRoom extends Room
{
    public function __construct()
    {
        parent::__construct(3000, "Люкс");
    }
}
