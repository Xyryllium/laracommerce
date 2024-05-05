<?php

declare(strict_types=1);

namespace App\Modules\Cart;

use App\Modules\Common\Helpers;

class CartMapper
{
    public static function mapFrom(array $data): Cart
    {
        return new Cart(
            $data["id"],
            $data['items'],
        );
    }
}
