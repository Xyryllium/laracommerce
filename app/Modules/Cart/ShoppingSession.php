<?php

declare(strict_types=1);

namespace App\Modules\Cart;

class ShoppingSession
{
    private string $id;
    private ?int $userId;
    private float $total;
    private string $createdAt;
    private ?string $updatedAt;

    function __construct(
        string $id,
        ?int $userId,
        float $total,
        string $createdAt,
        ?string $updatedAt
    ) {
        $this->id = $id;
        $this->userId = $userId;
        $this->total = $total;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function toArray(): array
    {
        return [
            "id" => $this->id,
            "userId" => $this->userId,
            "total" => $this->total,
            "createdAt" => $this->createdAt,
            "updatedAt" => $this->updatedAt,
        ];
    }

    public function toSQL(): array
    {
        return [
            "id" => $this->id,
            "user_id" => $this->userId,
            "total" => $this->total,
            "created_at" => $this->createdAt,
            "updated_at" => $this->updatedAt,
        ];
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function getTotal(): float
    {
        return $this->total;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }
}
