<?php

declare(strict_types=1);

namespace App\Modules\Product\Inventory;

use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class InventoryRepository
{
    private $tableName = 'product_inventory';
    private $columns = [
        'product_inventory.id',
        'product_inventory.quantity',
        'product_inventory.created_at AS createdAt',
        'product_inventory.updated_at AS updatedAt',
        'product_inventory.deleted_at AS deletedAt',
    ];

    public function get(int $id): Inventory
    {
        $selectColumns = implode(", ", $this->columns);
        $result = json_decode(json_encode(
            DB::selectOne("SELECT $selectColumns
                FROM {$this->tableName}
                WHERE id = :id", ["id" => $id])
        ), true);

        if (null === $result) {
            throw new InvalidArgumentException("Invalid Product Inventory ID!");
        }

        return InventoryMapper::mapFrom($result);
    }

    public function update(Inventory $inventory): Inventory
    {
        $result = DB::table($this->tableName)
            ->where("id", $inventory->getId())
            ->where("deleted_at", null)
            ->update([
                'quantity' => $inventory->getQuantity(),
                'updated_at' => date("Y-m-d H:i:s")
            ]);

        if (1 !== $result) {
            throw new InvalidArgumentException("Invalid Product Category ID!");
        }

        return $this->get($inventory->getId());
    }
}
