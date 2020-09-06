<?php

namespace App\Tests\Unit;

use App\Entity\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testComputeTVAFoodProduct()
    {
        $product = new Product('hamburger', Product::FOOD_PRODUCT, 10);

        self::assertSame(0.55, $product->computeTVA());
    }

    public function testComputeTVAProductTypeOther()
    {
        $product = new Product('hamburger', 'other type', 10);

        self::assertSame(1.96, $product->computeTVA());
    }

    public function testNegativePriceComputeTVA()
    {
        $product = new Product('autre produit', Product::FOOD_PRODUCT, -1);

        $this->expectException('LogicException');

        $product->computeTVA();        
    }
}