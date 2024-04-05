<?php

declare(strict_types=1);

namespace App\Modules\Product;

use App\Events\ProductCreated;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redis;

class ProductService
{
    private ProductRepository $repository;
    private ProductValidator $validator;

    public function __construct(
        ProductRepository $repository,
        ProductValidator $validator,
    ) {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function get(int $id): Product
    {
        return $this->repository->get($id);
    }

    public function getAll(): array
    {
        if(Redis::exists('all_products')) {
            $products = unserialize(Redis::get('all_products'));
        } else {
            $products = $this->repository->getAll();
            $expirationTimestamp = Carbon::now()->addMinutes(10)->timestamp;

            Redis::set('all_products', serialize($products), 'EX', $expirationTimestamp);
        }

        return $products;
    }

    public function create(array $data): Product
    {
        $this->validator->validateData($data);

        $product = $this->repository->create(
            ProductMapper::mapFrom($data)
        );

        event(new ProductCreated($product));

        return $product;
    }
}
