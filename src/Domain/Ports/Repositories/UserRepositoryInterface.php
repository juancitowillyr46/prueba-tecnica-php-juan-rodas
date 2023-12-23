<?php
namespace App\Domain\Ports\Repositories;

use App\Infrastructure\Database\Entities\UserEntity;

interface UserRepositoryInterface {
    public function saveUser(UserEntity $userEntity): ?UserEntity;
    public function updateUser(string $id, UserEntity $userEntity): ?UserEntity;
    public function deleteUser(string $id): bool;
    public function getById(string $id): ?UserEntity;
    public function getAll(): ?array;
}