<?php

declare(strict_types=1);

namespace App\Modules\Cart;

use InvalidArgumentException;

class CartValidator
{
    public function validateData(array $rawData): void
    {
        $validator = \validator($rawData, [
            'productId' => 'int',
            'quantity' => 'int',
            'price' => 'int',
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException(\json_encode($validator->errors()->all()));
        }
    }
}
