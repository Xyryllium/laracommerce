<?php

declare(strict_types=1);

namespace App\Modules\Product;

use InvalidArgumentException;

class ProductValidator
{
    public function validateData(array $rawData): void
    {
        $validator = \validator($rawData, [
            'id' => 'int',
            'name' => 'required|string',
            'description' => 'required|string',
            'category' => 'required|int',
            'quantity' => 'required|int',
            'price' => 'required|int',
            'image' => 'required|string',
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException(\json_encode($validator->errors()->all()));
        }
    }
}
