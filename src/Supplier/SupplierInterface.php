<?php

namespace App\Supplier;

use App\Exception\InvalidParserException;
use App\Parser\ParserInterface;
use App\Product\ProductCollectionInterface;
use App\Product\ProductDenormalizerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

interface SupplierInterface
{
    /**
     * @param string $name
     * @param string $productPath
     * @param ParserInterface $parser
     * @param ProductDenormalizerInterface $productDenormalizer
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(
        string $name,
        string $productPath,
        ParserInterface $parser,
        ProductDenormalizerInterface $productDenormalizer,
        EventDispatcherInterface $eventDispatcher
    );

    /**
     * @return ProductCollectionInterface
     * @throws InvalidParserException
     */
    public function getProducts(): ProductCollectionInterface;

    public function getName(): string;
}
