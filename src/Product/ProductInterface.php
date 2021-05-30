<?php

declare(strict_types=1);

namespace App\Product;

interface ProductInterface extends ToArrayInterface
{
    /**
     * @return string
     */
    public function getId(): string;
}