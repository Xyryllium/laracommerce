<?php

declare(strict_types=1);

namespace App\Modules\Sanctum;

use InvalidArgumentException;

class SanctumValidator
{
    public function validateIssueToken(array $rawData): void
    {
        $validator = \validator($rawData,[
            "username" => "required|string",
            "password" => "required|string",
        ]);

        if($validator->fails()) {
            throw new InvalidArgumentException(\json_encode($validator->errors()->all()));
        }
    }
}