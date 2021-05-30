<?php

namespace App\Event;

use App\Product\ProductInterface;
use Symfony\Contracts\EventDispatcher\Event;

class GetProductsEvent extends Event
{
    protected ProductInterface $products;

    protected string $supplierName;

    public function __construct(ProductInterface $products, string $supplierName)
    {
        $this->products = $products;
        $this->supplierName = $supplierName;
    }

    public function getProducts(): ProductInterface
    {
        return $this->products;
    }

    public function getSupplierName(): string
    {
        return $this->supplierName;
    }
}
