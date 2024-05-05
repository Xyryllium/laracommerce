<?php

declare(strict_types=1);

namespace App\Modules\Cart;

use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use Ramsey\Uuid\Uuid;

class CartRepository
{
    private $tableName = 'cart_item';
    private $selectColumns = [
        "cart_item.session_id AS sessionId",
        "cart_item.product_id AS productId",
        "cart_item.quantity",
        "cart_item.created_at AS createdAt",
        "cart_item.updated_at AS updatedAt",
    ];

    public function addItem(Cart $cart): string
    {
        $updates = [];
        $inserts = [];

        foreach ($cart->getItems() as $cartItem) {
            $existingItem = DB::table($this->tableName)
                ->where('session_id', $cart->getId())
                ->where('product_id', $cartItem['productId'])
                ->first();

            if ($existingItem) {
                $updates[] = [
                    'session_id' => $cart->getId(),
                    'product_id' => $cartItem['productId'],
                    'quantity' => $cartItem['quantity'],
                    'updated_at' => now()
                ];
            } else {
                $inserts[] = [
                    'session_id' => $cart->getId(),
                    'product_id' => $cartItem['productId'],
                    'quantity' => $cartItem['quantity'],
                    'created_at' => now()
                ];
            }
        }

        if (!empty($updates)) {
            foreach ($updates as $update) {
                $result = DB::table($this->tableName)
                    ->where('session_id', $update['session_id'])
                    ->where('product_id', $update['product_id'])
                    ->update([
                        'quantity' => $update['quantity'],
                        'updated_at' => $update['updated_at']
                    ]);
            }
        }

        if (!empty($inserts)) {
            $result = DB::table($this->tableName)->insert($inserts);
        }


        if (null === $result) {
            throw new InvalidArgumentException("Shopping Session creation is not successful!");
        }

        return 'Success';
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
