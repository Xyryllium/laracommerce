<?php

declare(strict_types=1);

namespace App\Modules\Product\Inventory;

use InvalidArgumentException;

class InventoryValidator
{
    public function validateData(array $rawData): void
    {
        $validator = \validator($rawData, [
            'id' => 'required|int',
            'quantity' => 'required|int'
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException(\json_encode($validator->errors()->all()));
        }
    }
}
