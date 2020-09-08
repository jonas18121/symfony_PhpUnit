<?php

namespace App\Tests\Unit;

use App\Entity\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    /**
     * pricesTVAFoodProduct sera appelé par @dataProvider qui ce trouve
     * dans testComputeTVAFoodProduct($price, $TVA), 
     * il y aura autant d'assertion qu'il y a de tableau de tableau
     * 
     * [
     *      [1000, 55.0] = [$price, $TVA]
     * ]
     */
    public function pricesTVAFoodProduct()
    {
        return [
            [0, 0.0],
            [10, 0.55],
            [100, 5.5],
            [1000, 55.0]
        ];
    }

    /**
     * @dataProvider pricesTVAFoodProduct
     */
    public function testComputeTVAFoodProduct($price, $TVA)
    {
        $product = new Product('hamburger', Product::FOOD_PRODUCT, $price);

        self::assertSame($TVA, $product->computeTVA());
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