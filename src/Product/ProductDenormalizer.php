<?php

declare(strict_types=1);

namespace App\Product;

final class ProductDenormalizer implements ProductDenormalizerInterface
{
    /**
     * @param array $data
     * @return Product
     */
    public function denormalize(array $data): Product
    {
        return new Product(
            ...array_values($data)
        );
    }
}