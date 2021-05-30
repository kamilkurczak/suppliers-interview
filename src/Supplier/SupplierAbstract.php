<?php

declare(strict_types=1);

namespace App\Supplier;

use App\Event\GetProductsEvent;
use App\Event\IntegrationEvents;
use App\Exception\InvalidParserException;
use App\Parser\ParserInterface;
use App\Product\ProductCollectionInterface;
use App\Product\ProductDenormalizerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

abstract class SupplierAbstract implements SupplierInterface
{
    protected string $name;
    protected string $responsePath;
    protected ParserInterface $parser;
    protected ProductDenormalizerInterface $productDenormalizer;
    protected EventDispatcherInterface $eventDispatcher;

    public function __construct(
        string $name,
        string $responsePath,
        ParserInterface $parser,
        ProductDenormalizerInterface $productDenormalizer,
        EventDispatcherInterface $eventDispatcher
    )
    {
        $this->name = $name;
        $this->responsePath = $responsePath;
        $this->parser = $parser;
        $this->productDenormalizer = $productDenormalizer;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @return array
     * @throws InvalidParserException
     * @throws \Exception
     */
    abstract protected function parseResponse(): array;

    /**
     * @param ProductCollectionInterface $data
     * @return array
     */
    abstract protected function denormalizeResponse(array $data): ProductCollectionInterface;

    /**
     * @return ProductCollectionInterface
     * @throws InvalidParserException
     */
    public function getProducts(): ProductCollectionInterface
    {
        $products = $this->denormalizeResponse(
            $this->parseResponse()
        );

        $this->eventDispatcher->dispatch(
            new GetProductsEvent($products, $this->getName()),
            IntegrationEvents::SUPPLIER_GET_PRODUCTS
        );

        return $products;
    }
}
