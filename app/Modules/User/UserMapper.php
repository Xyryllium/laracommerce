<?php

declare(strict_types=1);

namespace App\Modules\User;

use App\Modules\Common\Helpers;
use App\Modules\User\User;

class UserMapper
{
    public static function mapFrom(array $data): User
    {
        return new  User(
            Helpers::nullStringToInt($data["id"] ?? null),
            $data['username'],
            $data['firstName'],
            $data['lastName'],
            $data['email'],
            $data['password'] ?? null,
            $data['telephone'] ?? null,
            $data['createdAt'] ?? date('Y-m-d H:i:s'),
            $data['updatedAt'] ?? null,
        );
    }
}