<?php

declare(strict_types=1);

namespace App\Modules\Product;

use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class ProductRepository
{
    private $selectColumns = [
        "products.id",
        "products.name",
        "products.description",
        "products.price",
        "products.image",
        "product_inventory.quantity AS quantity",
        "product_category.name AS category",
        "products.created_at AS createdAt",
        "products.updated_at AS updatedAt",
        "products.deleted_at AS deletedAt"
    ];

    public function get(int $id): Product
    {
        $selectColumns = implode(", ", $this->selectColumns);
        $result = json_decode(json_encode(
            DB::selectOne("SELECT $selectColumns
                FROM products 
                JOIN product_category ON products.category_id = product_category.id
                JOIN product_inventory ON products.inventory_id = product_inventory.id
                WHERE products.id = :id", ["id" => $id])
        ), true);

        if (null === $result) {
            throw new InvalidArgumentException("Invalid Product ID!");
        }

        return ProductMapper::mapFrom($result);
    }

    public function getAll(): array
    {
        $selectColumns = implode(", ", $this->selectColumns);
        $result = json_decode(json_encode(
            DB::select("SELECT $selectColumns
                FROM products 
                JOIN product_category ON products.category_id = product_category.id
                JOIN product_inventory ON products.inventory_id = product_inventory.id"
            )), true);

        if (null === $result) {
            throw new InvalidArgumentException("No product is available!");
        }

        return $result;
    }

    public function create(Product $product): Product
    {
        $inventoryId = DB::table('product_inventory')
                ->insertGetId([
                   'quantity' => $product->getQuantity(),
                   'created_at' => now()
                ]);

        $product->setQuantity($inventoryId);

        $result = DB::table('products')
                    ->join('product_category', 'products.category_id', '=', 'product_category.id')
                    ->join('product_inventory', 'products.inventory_id', '=', 'product_inventory.id')
                    ->insertGetId($product->toSQL());

        if (null === $result) {
            throw new InvalidArgumentException("Product creation is not successful!");
        }

        return $this->get($result);
    }
}
