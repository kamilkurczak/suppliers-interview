<?php

declare(strict_types=1);

namespace App\Tests\Product;

use App\Product\ProductDenormalizer;
use App\Product\ProductDenormalizerInterface;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class ProductDenormalizerTest extends TestCase
{
    private ProductDenormalizerInterface $denormalizer;

    public function setUp(): void
    {
        $this->denormalizer = new ProductDenormalizer();
    }

    /**
     * @dataProvider getNamesProvider
     *
     * @param array $data
     * @param array $expectedAttributes
     */
    public function testDenormalize(
        array $data,
        array $expectedAttributes
    ): void
    {
        $product = $this->denormalizer->denormalize($data);
        $this->assertSame($product->toArray(), $expectedAttributes);
    }

    /**
     * @return \Generator
     */
    public function getNamesProvider(): \Generator
    {
        yield 'all data' => [
            'data' => [
                'key' => 'id',
                'title' => 'name',
                'desc' => 'description',
            ],
            'expected_attributes' => [
                'id' => 'id',
                'name' => 'name',
                'description' => 'description',
            ],
        ];

        yield 'missing description' => [
            'data' => [
                'key' => 'id',
                'title' => 'name',
            ],
            'expected_attributes' => [
                'id' => 'id',
                'name' => 'name',
                'description' => '',
            ],
        ];
    }
}
