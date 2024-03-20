<?php

declare(strict_types=1);

namespace App\Modules\Product\Category;

class Category
{
    private ?int $id;
    private string $username;
    private string $firstName;
    private string $lastName;
    private string $email;
    private ?string $password;
    private ?string $telephone;
    private string $createdAt;
    private ?string $updatedAt;

    function __construct(
        ?int $id,
        string $username,
        string $firstName,
        string $lastName,
        string $email,
        ?string $password,
        ?string $telephone,
        string $createdAt,
        ?string $updatedAt
    ) {
        $this->id = $id;
        $this->username = $username;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
        $this->telephone = $telephone;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function toArray(): array {
        return [
            "id" => $this->id,
            "username" => $this->username,
            "firstName" => $this->firstName,
            "lastName" => $this->lastName,
            "email" => $this->email,
            "telephone" => $this->telephone,
            "createdAt" => $this->createdAt,
            "updatedAt" => $this->updatedAt,
        ];
    }

    public function toSQL(): array {
        return [
            "id" => $this->id,
            "username" => $this->username,
            "first_name" => $this->firstName,
            "last_name" => $this->lastName,
            "email" => $this->email,
            "password" => bcrypt($this->password),
            "telephone" => $this->telephone,
            "created_at" => $this->createdAt,
            "updated_at" => $this->updatedAt,
        ];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }
}