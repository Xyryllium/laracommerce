<?php

declare(strict_types=1);

namespace App\Modules\Product\Inventory;

use App\Modules\Common\Helpers;

class InventoryMapper
{
    public static function mapFrom(array $data): Inventory
    {
        return new Inventory(
            Helpers::nullStringToInt($data["id"] ?? null),
            Helpers::nullStringToInt($data["quantity"] ?? null),
            $data['createdAt'] ?? date('Y-m-d H:i:s'),
            $data['updatedAt'] ?? null,
            $data['deletedAt'] ?? null,
        );
    }
}
