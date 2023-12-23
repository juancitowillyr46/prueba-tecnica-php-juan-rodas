<?php
namespace App\Infrastructure\Database\Persistence;

use App\Domain\Ports\Repositories\DBConnectionInterface;
use App\Infrastructure\Database\Entities\UserEntity;
use App\Domain\Ports\Repositories\UserRepositoryInterface;
use PDO;
use Ramsey\Uuid\Nonstandard\Uuid;

class UserRepository implements UserRepositoryInterface {

    private $users = [];

    public function saveUser(UserEntity $userEntity): ?UserEntity {
        $this->users[$userEntity->getId()] = $userEntity;
        return $userEntity;
    }
    public function updateUser(string $id, UserEntity $userEntity): ?UserEntity {
        if(isset($this->users[$id])){
            $this->users[$id] = $userEntity;
            return $this->users[$id];
        }
        return null;
    }
    public function deleteUser(string $id): bool {
        if(isset($this->users[$id])) {
            unset($this->users[$id]);
            return true;
        }
        return false;
    }
    public function getById(string $id): ?UserEntity {
        return isset($this->users[$id])? $this->users[$id] : null;
    }

    public function getAll(): ?array {
        return $this->users;
    }
}