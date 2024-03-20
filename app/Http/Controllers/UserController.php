<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Modules\Core\HTTPResponseCodes;
use App\Modules\User\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController
{
    private UserService $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function get(int $id): Response
    {
        try {
            return new Response($this->service->get($id)->toArray());
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

    public function update(Request $request): Response
    {
        try {
            $dataArray = ($request->toArray() !== [])
                ? $request->toArray()
                : $request->json()->all();
            return new Response(
                $this->service->update($dataArray)->toArray(),
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