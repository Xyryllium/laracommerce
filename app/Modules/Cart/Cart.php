<?php

declare(strict_types=1);

namespace App\Modules\Cart;

class Cart
{
    private string $id;
    private array $items;

    function __construct(
        string $id,
        array $items,
    ) {
        $this->id = $id;
        $this->items = $items;
    }

    public function toArray(): array
    {
        return [
            "id" => $this->id,
            "items" => $this->items,
        ];
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getItems(): array
    {
        return $this->items;
    }
}
