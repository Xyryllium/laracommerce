<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Modules\Core\HTTPResponseCodes;
use App\Modules\Product\Category\CategoryService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController
{
    private CategoryService $productCategoryService;

    public function __construct(
        CategoryService $productCategoryService,
    ) {
        $this->productCategoryService = $productCategoryService;
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

    // public function update(Request $request): Response
    // {
    //     try {
    //         $dataArray = ($request->toArray() !== [])
    //             ? $request->toArray()
    //             : $request->json()->all();
    //         return new Response(
    //             $this->service->update($dataArray)->toArray(),
    //             HTTPResponseCodes::Success['code']
    //         );
    //     } catch (Exception $error) {
    //         return new Response(
    //             [
    //                 "exception" => get_class($error),
    //                 "errors" => $error->getMessage(),
    //             ],
    //             HTTPResponseCodes::BadRequest['code']
    //         );
    //     }
    // }
}