<?php

declare(strict_types=1);

namespace App;

class Product
{
    public string $name;
    public string $manufacturer;
    public float $price;
    public ?float $discount = null;

    private function __construct()
    {
    }

    public static function create(): Product
    {
        return new Product();
    }

    public function equals(self $other): bool
    {
        return $this->name === $other->name &&
            $this->manufacturer === $other->manufacturer &&
            $this->price === $other->price &&
            $this->discount === $other->discount;
    }
}
