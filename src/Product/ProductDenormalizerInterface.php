<?php

declare(strict_types=1);

namespace App\Product;

interface ProductDenormalizerInterface
{
    /**
     * @param array $data
     * @return Product
     */
    public function denormalize(array $data): Product;
}