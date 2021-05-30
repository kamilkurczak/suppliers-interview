<?php

declare(strict_types=1);

namespace App\Supplier;

use App\Exception\SupplierDoesNotExistsException;
use App\Product\ProductCollectionInterface;

final class SupplierCollection
{
    /**
     * @var SupplierInterface[]
     */
    private iterable $suppliers;

    /**
     * @param iterable $suppliers
     */
    public function __construct(iterable $suppliers)
    {
        $this->suppliers = $suppliers;
    }

    /**
     * @param string $supplierName
     * @return ProductCollectionInterface
     * @throws SupplierDoesNotExistsException
     * @throws \App\Exception\InvalidParserException
     */
    public function getProducts(string $supplierName): ProductCollectionInterface
    {
        foreach ($this->suppliers as $supplier) {
            if ($supplier->getName() == $supplierName) {
                return $supplier->getProducts();
            }
        }

        throw new SupplierDoesNotExistsException();
    }
}
