<?php

declare(strict_types=1);

namespace App\Modules\Product;

class Product
{
    private ?int $id;
    private string $name;
    private string $description;
    private string $category;
    private float $price;
    private int $quantity;
    private string $image;
    private string $createdAt;
    private ?string $updatedAt;
    private ?string $deletedAt;

    function __construct(
        ?int $id,
        string $name,
        string $description,
        string $category,
        float $price,
        int $quantity,
        string $image,
        string $createdAt,
        ?string $updatedAt,
        ?string $deletedAt,
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->category = $category;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->image = $image;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->deletedAt = $deletedAt;
    }

    public function toArray(): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "description" => $this->description,
            "category" => $this->category,
            "price" => $this->price,
            "quantity" => $this->quantity,
            "image" => $this->image,
            "createdAt" => $this->createdAt,
            "updatedAt" => $this->updatedAt,
            "deletedAt" => $this->deletedAt,
        ];
    }

    public function toSQL(): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "category_id" => $this->category,
            "description" => $this->description,
            "inventory_id" => $this->quantity,
            "price" => $this->price,
            "image" => $this->image,
            "created_at" => $this->createdAt,
            "updated_at" => $this->updatedAt,
            "deleted_at" => $this->deletedAt,
        ];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getImage(): string
    {
        return $this->image;
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
