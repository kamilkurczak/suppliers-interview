<?php

declare(strict_types=1);

namespace App\Product;

final class Product implements ProductInterface
{
    private string $id;
    private string $name;
    private string $description;

    /**
     * @param string $id
     * @param string $name
     * @param string $description
     */
    public function __construct(string $id, string $name, string $description = '')
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
        ];
    }
}