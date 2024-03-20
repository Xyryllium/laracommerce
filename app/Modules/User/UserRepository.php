<?php

declare(strict_types=1);

namespace App\Modules\User;

use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class UserRepository 
{
    private $tableName = 'users';
    private $selectColumns = [
        "users.id",
        "users.username",
        "users.first_name AS firstName",
        "users.last_name AS lastName",
        "users.email",
        "users.telephone",
        "users.created_at AS createdAt",
        "users.updated_at AS updatedAt"
    ];

    public function get(int $id): User
    {
        $selectColumns = implode(", ", $this->selectColumns);
        $result = json_decode(json_encode(
            DB::selectOne("SELECT $selectColumns
                FROM {$this->tableName}
                WHERE id = :id", ["id" => $id])
        ), true);

        if (null === $result) {
            throw new InvalidArgumentException("Invalid User ID!");
        }

        return UserMapper::mapFrom($result);
    }

    public function update(User $user): User
    {
        return DB::transaction(function () use ($user) {
            DB::table($this->tableName)->updateOrInsert([
                "id" => $user->getId()
            ], $user->toSQL());

            $id = ($user->getId() === null || $user->getId() === 0)
                    ? (int)DB::getPdo()->lastInsertId()
                    : $user->getId();
            
            return $this->get($id);
        });
    }
}