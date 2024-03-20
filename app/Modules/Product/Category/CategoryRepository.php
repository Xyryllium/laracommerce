<?php

declare(strict_types=1);

namespace App\Modules\Product\Category;

use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class CategoryRepository 
{
    private $tableName = 'product_category';
    private $selectColumns = [
        "product_category.id",
        "product_category.name",
        "product_category.description",
        "product_category.created_at AS createdAt",
        "product_category.updated_at AS updatedAt",
        "product_category.deleted_at AS deletedAt"
    ];

    public function get(int $id): Category
    {
        $selectColumns = implode(", ", $this->selectColumns);
        $result = json_decode(json_encode(
            DB::selectOne("SELECT $selectColumns
                FROM {$this->tableName}
                WHERE id = :id", ["id" => $id])
        ), true);

        if (null === $result) {
            throw new InvalidArgumentException("Invalid Product Category ID!");
        }

        return CategoryMapper::mapFrom($result);
    }

    // public function update(User $user): User
    // {
    //     return DB::transaction(function () use ($user) {
    //         DB::table($this->tableName)->updateOrInsert([
    //             "id" => $user->getId()
    //         ], $user->toSQL());

    //         $id = ($user->getId() === null || $user->getId() === 0)
    //                 ? (int)DB::getPdo()->lastInsertId()
    //                 : $user->getId();
            
    //         return $this->get($id);
    //     });
    // }
}