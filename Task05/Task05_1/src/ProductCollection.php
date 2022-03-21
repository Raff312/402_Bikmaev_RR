<?php

declare(strict_types=1);

namespace App;

class ProductCollection
{
    private array $products = array();

    private function __construct(Product ...$products)
    {
        $this->products = $products;
    }

    public static function create(Product ...$products): ProductCollection
    {
        return new ProductCollection(...$products);
    }

    public function getProductsArray(): array
    {
        return $this->products;
    }

    public function filter(ProductFilteringStrategy $filterStrategy): ProductCollection
    {
        return new ProductCollection(...$filterStrategy->filter(...$this->products));
    }
}
