<?php

declare(strict_types=1);

namespace App\Modules\Cart;

use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use Ramsey\Uuid\Uuid;

class ShoppingSessionRepository
{
    private $tableName = 'shopping_session';
    private $selectColumns = [
        "shopping_session.id",
        "shopping_session.user_id AS userId",
        "shopping_session.total",
        "shopping_session.created_at AS createdAt",
        "shopping_session.updated_at AS updatedAt",
    ];

    public function get(string $id): ShoppingSession
    {
        $selectColumns = implode(", ", $this->selectColumns);
        $result = json_decode(json_encode(
            DB::selectOne("SELECT $selectColumns
                FROM $this->tableName
                WHERE shopping_session.id = :id", ["id" => $id])
        ), true);

        if (null === $result) {
            throw new InvalidArgumentException("Invalid Shopping Session ID!");
        }

        return ShoppingSessionMapper::mapFrom($result);
    }

    public function createSession(?int $userId): ShoppingSession
    {
        $generatedUuid = (string) Uuid::uuid4();
        $result = DB::table($this->tableName)
            ->insert([
                'id' => $generatedUuid,
                'user_id' => $userId,
                'total' => 0,
                'created_at' => now()
            ]);

        if (null === $result) {
            throw new InvalidArgumentException("Shopping Session creation is not successful!");
        }

        return $this->get($generatedUuid);
    }

    public function updateTotal(ShoppingSession $data): float
    {
        $result = DB::table($this->tableName)
            ->where("id", $data->getId())
            ->update([
                'total' => $data->getTotal(),
                'updated_at' => date("Y-m-d H:i:s")
            ]);

        if (1 !== $result) {
            throw new InvalidArgumentException("Invalid Shopping Cart Session!");
        }

        return $data->getTotal();
    }
}
