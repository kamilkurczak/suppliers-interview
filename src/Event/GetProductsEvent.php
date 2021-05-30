<?php

namespace App\Event;

use App\Product\ProductCollectionInterface;
use Symfony\Contracts\EventDispatcher\Event;

class GetProductsEvent extends Event
{
    protected ProductCollectionInterface $products;

    protected string $supplierName;

    public function __construct(ProductCollectionInterface $products, string $supplierName)
    {
        $this->products = $products;
        $this->supplierName = $supplierName;
    }

    public function getProducts(): ProductCollectionInterface
    {
        return $this->products;
    }

    public function getSupplierName(): string
    {
        return $this->supplierName;
    }
}
