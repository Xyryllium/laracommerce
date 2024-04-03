<?php

declare(strict_types=1);

namespace App\Modules\Product\Inventory;

class Inventory
{
    private ?int $id;
    private int $quantity;
    private string $createdAt;
    private ?string $updatedAt;
    private ?string $deletedAt;

    function __construct(
        ?int $id,
        int $quantity,
        string $createdAt,
        ?string $updatedAt,
        ?string $deletedAt,
    ) {
        $this->id = $id;
        $this->quantity = $quantity;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->deletedAt = $deletedAt;
    }

    public function toArray(): array
    {
        return [
            "id" => $this->id,
            "quantity" => $this->quantity,
            "createdAt" => $this->createdAt,
            "updatedAt" => $this->updatedAt,
            "deletedAt" => $this->deletedAt,
        ];
    }

    public function toSQL(): array
    {
        return [
            "id" => $this->id,
            "quantity" => $this->quantity,
            "created_at" => $this->createdAt,
            "updated_at" => $this->updatedAt,
            "deleted_at" => $this->deletedAt,
        ];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }

    public function getDeletedAt(): ?string
    {
        return $this->deletedAt;
    }
}
