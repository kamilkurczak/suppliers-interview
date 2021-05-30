<?php

namespace App\Listener;

use App\Event\GetProductsEvent;
use Monolog\Handler\StreamHandler;
use Psr\Log\LoggerInterface;
use Monolog\Logger;
use Symfony\Contracts\EventDispatcher\Event;

class ProductsListener
{
    const FILENAME_PATH = './var/log/supplier.log';

    protected LoggerInterface $logger;

    public function __construct(LoggerInterface $logger = null)
    {
        $this->logger = $logger ?? new Logger(
                'suppliers_logger',
                [new StreamHandler(self::FILENAME_PATH, Logger::INFO)]
            );
    }

    public function onSupplierGetProducts(Event $event)
    {
        $this->logProducts($event);
    }

    public function logProducts(Event $event): bool
    {
        if ($event instanceof GetProductsEvent) {
            foreach ($event->getProducts() as $product) {
                $this->logger->info(
                    'Product added: ' . $product->getId(),
                    ['supplier' => $event->getSupplierName()]
                );
            }
        }

        return true;
    }
}
