<?php
namespace App\Domain\Ports\Services;

use App\Domain\Models\UserModel;

interface UserServiceInterface {
    public function saveUser(UserModel $userModel): ?UserModel;
    public function updateUser(string $id, UserModel $userModel): ?UserModel;
    public function deleteUser(string $id): bool;
    public function getById(string $id): ?UserModel;
    public function getAll(): ?array;
}