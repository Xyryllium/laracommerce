<?php

declare(strict_types=1);

namespace App\Modules\Cart;

class CartTotalCalculator
{
    public function calculateTotal(array $items): float
    {
        $total = 0;

        foreach ($items as $item) {
            $itemTotal = $item['quantity'] * $item['price'];
            $total += $itemTotal;
        }

        return $total;
    }
}
