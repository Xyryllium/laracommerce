<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Modules\Core\HTTPResponseCodes;
use App\Modules\Product\Category\CategoryService;
use App\Modules\Product\Inventory\InventoryService;
use App\Modules\Product\ProductService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController
{
    private CategoryService $productCategoryService;
    private InventoryService $productInventoryService;
    private ProductService $productService;

    public function __construct(
        CategoryService $productCategoryService,
        InventoryService $productInventoryService,
        ProductService $productService
    ) {
        $this->productCategoryService = $productCategoryService;
        $this->productInventoryService = $productInventoryService;
        $this->productService = $productService;
    }

    public function getProducts(): Response
    {
        try {
            return new Response($this->productService->getAll());
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

    public function createProduct(Request $request): Response
    {
        try {
            $dataArray = ($request->toArray() !== [])
                ? $request->toArray()
                : $request->json()->all();
            return new Response(
                $this->productService->create($dataArray)->toArray(),
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

    public function getProductById(int $id): Response
    {
        try {
            return new Response($this->productService->get($id)->toArray());
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

    public function getCategory(int $id): Response
    {
        try {
            return new Response($this->productCategoryService->get($id)->toArray());
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

    public function updateCategory(Request $request): Response
    {
        try {
            $dataArray = ($request->toArray() !== [])
                ? $request->toArray()
                : $request->json()->all();
            return new Response(
                $this->productCategoryService->update($dataArray)->toArray(),
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

    public function softDeleteCategory(int $id): Response
    {
        try {
            return new Response($this->productCategoryService->softDelete($id));
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

    public function updateInventory(Request $request): Response
    {
        try {
            $dataArray = ($request->toArray() !== [])
                ? $request->toArray()
                : $request->json()->all();
            return new Response(
                $this->productInventoryService->update($dataArray)->toArray(),
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
