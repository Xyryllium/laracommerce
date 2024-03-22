<?php

declare(strict_types=1);

namespace App\Modules\Product\Category;

use InvalidArgumentException;

class CategoryValidator
{
    public function validateData(array $rawData): void
    {
        $validator = \validator($rawData, [
            'name' => 'required|string',
            'description' => 'required|string'
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException(\json_encode($validator->errors()->all()));
        }
    }
}
