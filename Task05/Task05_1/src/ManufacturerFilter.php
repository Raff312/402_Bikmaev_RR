<?php

declare(strict_types=1);

namespace App;

class ManufacturerFilter implements ProductFilteringStrategy
{
    private string $manufacturer;

    private function __construct(string $manufacturer)
    {
        $this->manufacturer = $manufacturer;
    }

    public static function create(string $manufacturer): ManufacturerFilter
    {
        return new ManufacturerFilter($manufacturer);
    }

    public function filter(Product ...$products): array
    {
        $result = array();
        foreach ($products as $product) {
            if ($product->manufacturer === $this->manufacturer) {
                $result[] = $product;
            }
        }

        return $result;
    }
}
