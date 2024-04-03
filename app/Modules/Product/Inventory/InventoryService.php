<?php

declare(strict_types=1);

namespace App\Modules\Product\Inventory;

class InventoryService
{
    private InventoryValidator $validator;
    private InventoryRepository $repository;

    public function __construct(
        InventoryValidator $validator,
        InventoryRepository $repository,
    ) {
        $this->validator = $validator;
        $this->repository = $repository;
    }

    public function update(array $data): Inventory
    {
        $this->validator->validateData($data);

        return $this->repository->update(InventoryMapper::mapFrom($data));
    }
}
