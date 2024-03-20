<?php

declare(strict_types=1);

namespace App\Modules\User;

use InvalidArgumentException;

class UserValidator
{
   public function validateData(array $rawData): void
   {
        $validator = \validator($rawData,[
            "username" => "required|string",
            "firstName" => "required|string",
            "lastName" => "required|string",
            "email" => "required|string|email",
            "password" => "required|string",
            "telephone" => "string",
        ]);

        if($validator->fails()) {
            throw new InvalidArgumentException(\json_encode($validator->errors()->all()));
        }
   }
}