<?php 
namespace App\Application\UseCases;

use App\Application\UseCases\Interfaces\DeleteUserUseCaseInterface;
use App\Domain\Ports\Services\UserServiceInterface;

class DeleteUserUseCase implements DeleteUserUseCaseInterface {
    private UserServiceInterface $_userService;
    public function __construct(UserServiceInterface $userService)
    {
        $this->_userService = $userService;
    }

    public function execute(string $id): bool {
        $save = $this->_userService->deleteUser($id);
        return (!$save);
    }
}