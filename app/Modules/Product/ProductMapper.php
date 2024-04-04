<?php

declare(strict_types=1);

namespace App\Modules\Product;

use App\Modules\Common\Helpers;

class ProductMapper
{
    public static function mapFrom(array $data): Product
    {
        return new Product(
            Helpers::nullStringToInt($data["id"] ?? null),
            $data['name'],
            $data['description'],
            $data['category'],
            $data['price'],
            $data['quantity'],
            $data['image'],
            $data['createdAt'] ?? date('Y-m-d H:i:s'),
            $data['updatedAt'] ?? null,
            $data['deletedAt'] ?? null,
        );
    }
}
