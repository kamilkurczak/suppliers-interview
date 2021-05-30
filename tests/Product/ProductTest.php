<?php

declare(strict_types=1);

namespace App\Tests\Product;

use App\Product\Product;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class ProductTest extends TestCase
{
    /**
     * @dataProvider getProductProvider
     *
     * @param string $id
     * @param string $name
     * @param string $description
     * @param array $expectedAttributes
     */
    public function testToArray(string $id, string $name, string $description, array $expectedAttributes): void
    {
        $product = new Product($id, $name, $description);

        $this->assertSame($product->toArray(), $expectedAttributes);
    }

    /**
     * @return \Generator
     */
    public function getProductProvider(): \Generator
    {
        yield 'all data' => [
            'id' => 'id',
            'name' => 'name',
            'description' => 'description',
            'expected_attributes' => [
                'id' => 'id',
                'name' => 'name',
                'description' => 'description',
            ],
        ];

        yield 'missing description' => [
            'id' => 'id',
            'name' => 'name',
            'description' => '',
            'expected_attributes' => [
                'id' => 'id',
                'name' => 'name',
                'description' => '',
            ],
        ];
    }
}
