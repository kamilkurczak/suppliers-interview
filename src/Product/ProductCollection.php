<?php

declare(strict_types=1);

namespace App\Product;

final class ProductCollection implements ProductInterface, ProductCollectionInterface
{
    /**
     * @var ProductInterface[]
     */
    private array $products;

    /**
     * @param ProductInterface ...$products
     */
    public function __construct(ProductInterface ...$products)
    {
        $this->products = $products;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $products = [];
        foreach ($this->products as $product) {
            $products[] = $product->ToArray();
        }

        return $products;
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->products);
    }
}