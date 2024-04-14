<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Modules\Cart\CartService;
use App\Modules\Core\HTTPResponseCodes;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CartController
{
    private CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function createSession(Request $request): Response
    {
        try {
            $userId = null;

            if ($request->bearerToken()) {
                $userId = auth('sanctum')->user()->id;
            }

            return new Response(
                $this->cartService->createSession($userId)->toArray(),
                HTTPResponseCodes::Success['code']
            );
        } catch (Exception $error) {
            return new Response(
                [
                    "exception" => get_class($error),
                    "errors" => $error->getMessage(),
                ],
                HTTPResponseCodes::BadRequest['code']
            );
        }
    }

    public function addToCart(Request $request): Response
    {
        try {
            $dataArray = ($request->toArray() !== [])
                ? $request->toArray()
                : $request->json()->all();

            if ($request->bearerToken()) {
                $dataArray['userId'] = auth('sanctum')->user()->id;
            }

            $this->cartService->updateTotal($dataArray);
            $this->cartService->addItems($dataArray);
            return new Response(
                HTTPResponseCodes::Success['code']
            );
        } catch (Exception $error) {
            return new Response(
                [
                    "exception" => get_class($error),
                    "errors" => $error->getMessage(),
                ],
                HTTPResponseCodes::BadRequest['code']
            );
        }
    }
}
