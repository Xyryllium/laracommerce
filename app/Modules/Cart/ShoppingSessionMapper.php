<?php

declare(strict_types=1);

namespace App\Modules\Cart;

use App\Modules\Common\Helpers;
use App\Modules\Cart\ShoppingSession;

class ShoppingSessionMapper
{
    public static function mapFrom(array $data): ShoppingSession
    {
        return new ShoppingSession(
            $data['id'],
            $data["userId"] ?? null,
            $data['total'],
            $data['createdAt'] ?? date('Y-m-d H:i:s'),
            $data['updatedAt'] ?? null,
        );
    }
}
