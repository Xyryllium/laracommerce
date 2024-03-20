<?php

declare(strict_types=1);

namespace App\Modules\User;

use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class UserService
{
    private UserRepository $repository;
    private UserValidator $validator;

    public function __construct(
        UserRepository $repository,
        UserValidator $validator
    ) {
        $this->repository = $repository;
        $this->validator = $validator;
    }
    
    public function get(int $id): User
    {
        return $this->repository->get($id);
    }

    public function update(array $data): User
    {
        $this->validator->validateData($data);

        return $this->repository->update(
            UserMapper::mapFrom($data)
        );
    }
}