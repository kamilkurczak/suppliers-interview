<?php

declare(strict_types=1);

namespace App\Product;

interface ToArrayInterface
{
    /**
     * @return array
     */
    public function toArray(): array;
}