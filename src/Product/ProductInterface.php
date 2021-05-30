<?php

declare(strict_types=1);

namespace App\Product;

interface ProductInterface
{
    /**
     * @return array
     */
    public function toArray(): array;
}