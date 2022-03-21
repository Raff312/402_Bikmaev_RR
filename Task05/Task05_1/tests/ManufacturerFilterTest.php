<?php

declare(strict_types=1);

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\ManufacturerFilter;
use App\Product;
use App\ProductCollection;

final class ManufacturerFilterTest extends TestCase
{
    public function testFilter(): void
    {
        // arrange
        $p1 = Product::create();
        $p1->name = 'Шоколад';
        $p1->price = 100;
        $p1->manufacturer = 'Красный Октябрь';

        $p2 = Product::create();
        $p2->name = 'Мармелад';
        $p2->price = 50;
        $p2->manufacturer = 'Ламзурь';

        $collection = ProductCollection::create(...[$p1, $p2]);

        // act
        $resultCollection = $collection->filter(ManufacturerFilter::create('Ламзурь'));

        // assert
        $resultCollectionArr = $resultCollection->getProductsArray();

        $this->assertSame(1, count($resultCollectionArr));
        $this->assertObjectEquals($p2, $resultCollectionArr[0]);
    }
}
