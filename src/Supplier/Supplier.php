<?php

declare(strict_types=1);

namespace App\Supplier;

use App\Event\GetProductsEvent;
use App\Event\IntegrationEvents;
use App\Product\ProductCollection;
use App\Product\ProductInterface;

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
     * @param ProductInterface $data
     * @return array
     */
    protected function denormalizeResponse(array $data): ProductInterface
    {
        $products = [];
        foreach (end($data) as $product) {
            $products[] = $this->productDenormalizer->denormalize($product);
        }

        return new ProductCollection(...$products);
    }
}
