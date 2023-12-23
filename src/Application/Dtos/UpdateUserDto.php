<?php
namespace App\Application\Dtos;

use App\Domain\Models\UserModel;

class UpdateUserDto {
    public $fullName;
    public $email;
    public $password;

    public function toModel(UpdateUserDto $dto): UserModel {
        $userModel = new UserModel();
        $userModel->setFullName($dto->fullName);
        $userModel->setEmail($dto->email);
        $userModel->setPassword($dto->password);
        return $userModel;
    }
}