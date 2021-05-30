<?php

declare(strict_types=1);

namespace App\Tests\Supplier;

use App\Parser\JsonParser;
use App\Parser\XmlParser;
use App\Product\ProductDenormalizer;
use App\Product\ProductInterface;
use App\Supplier\Supplier;
use PHPUnit\Framework\TestCase;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;

/**
 * @internal
 */
final class SupplierTest extends TestCase
{
    public function testGetProductsJson()
    {
        $parser = new JsonParser(new JsonEncoder());
        $denormalizer = new ProductDenormalizer();
        $eventDispatcher = new EventDispatcher();
        $supplier = new Supplier(
            'SUPPLIER 1',
            __DIR__ . '/../../public/suppliers/supplier3.json',
            $parser,
            $denormalizer,
            $eventDispatcher
        );

        $products = $supplier->getProducts();
        $this->assertInstanceOf(ProductInterface::class, $products);
        $this->assertCount(3, $products->toArray());
    }

    public function testGetProductsXml()
    {
        $parser = new XmlParser(new XmlEncoder());
        $denormalizer = new ProductDenormalizer();
        $eventDispatcher = new EventDispatcher();
        $supplier = new Supplier(
            'SUPPLIER 2',
            __DIR__ . '/../../public/suppliers/supplier2.xml',
            $parser,
            $denormalizer,
            $eventDispatcher
        );

        $products = $supplier->getProducts();
        $this->assertInstanceOf(ProductInterface::class, $products);
        $this->assertCount(8, $products->toArray());
    }
}
