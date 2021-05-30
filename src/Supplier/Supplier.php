<?php

declare(strict_types=1);

namespace App\Supplier;

use App\Product\ProductCollection;
use App\Product\ProductCollectionInterface;

final class Supplier extends SupplierAbstract
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array
     * @throws \App\Exception\InvalidParserException
     */
    protected function parseResponse(): array
    {
        return $this->parser->parse($this->getResponse());
    }

    /**
     * @return bool|string
     */
    protected function getResponse(): string|bool
    {
        return file_get_contents($this->responsePath);
    }

    /**
     * @param ProductCollectionInterface $data
     * @return array
     */
    protected function denormalizeResponse(array $data): ProductCollectionInterface
    {
        $products = [];
        foreach (end($data) as $product) {
            $products[] = $this->productDenormalizer->denormalize($product);
        }

        return new ProductCollection(...$products);
    }
}
