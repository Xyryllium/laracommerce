<?php

declare(strict_types=1);

namespace App\Modules\Cart;

class CartService
{
    private ShoppingSessionRepository $shoppingSessionRepository;
    private CartValidator $validator;
    private CartRepository $cartRepository;

    public function __construct(
        ShoppingSessionRepository $shoppingSessionRepository,
        CartValidator $validator,
        CartRepository $cartRepository,
        private CartTotalCalculator $totalCalculator,
    ) {
        $this->shoppingSessionRepository = $shoppingSessionRepository;
        $this->validator = $validator;
        $this->cartRepository = $cartRepository;
        $this->totalCalculator = $totalCalculator;
    }

    public function createSession(int $userId = null): ShoppingSession
    {
        return $this->shoppingSessionRepository->createSession($userId);
    }

    public function addItem(array $data): string
    {
        $this->validator->validateData($data['items']);

        $cart = $this->cartRepository->addItem(
            CartMapper::mapFrom($data)
        );

        return $cart;
    }

    public function updateTotal(array $data): float
    {
        $data['total'] = $this->totalCalculator->calculateTotal($data['items']);

        return $this->shoppingSessionRepository->updateTotal(
            ShoppingSessionMapper::mapFrom($data)
        );
    }
}
