<?php 
namespace App\Application\Services;

use App\Domain\Models\UserModel;
use App\Domain\Ports\Services\UserServiceInterface;
use App\Domain\Ports\Repositories\UserRepositoryInterface;

class UserService implements UserServiceInterface {

    private UserRepositoryInterface $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function saveUser(UserModel $userModel): ?UserModel {
        $entity = $userModel->toEntity($userModel);
        $save = $this->userRepository->saveUser($entity);
        return $entity->toModel($save);
    }
    public function updateUser(string $id, UserModel $userModel): ?UserModel {
        $exist = $this->userRepository->getById($id);
        if($exist) {
            $entity = $userModel->toEntity($userModel);
            $save = $this->userRepository->updateUser($id, $entity);
            return $entity->toModel($save);
        }
        return null;
    }
    
    public function deleteUser(string $id): bool {
        $exist = $this->userRepository->getById($id);
        if($exist) {
            return $this->userRepository->deleteUser($id);
        }
        return false;
    }

    public function getById(string $id): ?UserModel {
        $exist = $this->userRepository->getById($id);
        if($exist) {
            return $exist->toModel($exist);
        }
        return null;
    }

    public function getAll(): ?array {
        return $this->userRepository->getAll();
    }
}