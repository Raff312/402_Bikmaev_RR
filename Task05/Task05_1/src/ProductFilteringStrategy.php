<?php

declare(strict_types=1);

namespace App;

interface ProductFilteringStrategy
{
    public function filter(Product ...$products): array;
}
