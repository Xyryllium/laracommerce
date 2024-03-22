<?php

declare(strict_types=1);

namespace App\Modules\Product\Category;

use App\Modules\Common\Helpers;

class CategoryMapper
{
    public static function mapFrom(array $data): Category
    {
        return new  Category(
            Helpers::nullStringToInt($data["id"] ?? null),
            $data['name'],
            $data['description'],
            $data['createdAt'] ?? date('Y-m-d H:i:s'),
            $data['updatedAt'] ?? null,
            $data['deletedAt'] ?? null,
        );
    }
}
