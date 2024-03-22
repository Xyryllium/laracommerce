<?php

declare(strict_types=1);

namespace App\Modules\Product\Category;

class CategoryService
{
    private CategoryRepository $repository;
    private CategoryValidator $validator;

    public function __construct(
        CategoryRepository $repository,
        CategoryValidator $validator
    ) {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function get(int $id): Category
    {
        return $this->repository->get($id);
    }

    public function update(array $data): Category
    {
        $this->validator->validateData($data);

        return $this->repository->update(
            CategoryMapper::mapFrom($data)
        );
    }

    public function softDelete(int $id): bool
    {
        return $this->repository->softDelete($id);
    }
}
