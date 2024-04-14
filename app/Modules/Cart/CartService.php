<?php

declare(strict_types=1);

namespace App\Modules\Cart;

class CartService
{
    private ShoppingSessionRepository $shoppingSessionRepository;

    public function __construct(
        ShoppingSessionRepository $shoppingSessionRepository
    ) {
        $this->shoppingSessionRepository = $shoppingSessionRepository;
    }

    public function createSession(int $userId = null): ShoppingSession
    {
        return $this->shoppingSessionRepository->createSession($userId);
    }

    public function updateTotal(array $data): float
    {
        $data['total'] = $this->calculateCartTotal($data);

        return $this->shoppingSessionRepository->updateTotal(
            ShoppingSessionMapper::mapFrom($data)
        );
    }

    private function calculateCartTotal(array $data): float
    {
        $total = 0;

        foreach ($data['items'] as $item) {
            $itemTotal = $item['quantity'] * $item['price'];
            $total += $itemTotal;
        }

        return $total;
    }
}
