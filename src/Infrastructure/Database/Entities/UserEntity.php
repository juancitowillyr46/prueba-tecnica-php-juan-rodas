<?php
namespace App\Infrastructure\Database\Entities;

use App\Domain\Models\UserModel;
use Ramsey\Uuid\Nonstandard\Uuid;

class UserEntity {

    private string $id;
    private string $fullName;   
    private string $email;
    private string $password;

    public function __construct() {
        $this->id = Uuid::uuid4();
    }

    public function setId(string $id): void {
        $this->id = $id;
    }

    public function getId(): string {
        return $this->id;
    }
    public function setFullName(string $fullName): void {
        $this->fullName = $fullName;
    }

    public function getFullName(): string {
        return $this->fullName;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setPassword(string $password): void {
        $this->password = $password;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function toModel(UserEntity $entity): UserModel {
        $userModel = new UserModel();
        $userModel->setId($entity->getId());
        $userModel->setFullName($entity->getFullName());
        $userModel->setEmail($entity->getEmail());
        $userModel->setPassword($entity->getPassword());
        return $userModel;
    }
}