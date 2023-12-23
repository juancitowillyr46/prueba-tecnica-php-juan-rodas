<?php 
namespace App\Application\UseCases;

use App\Application\Dtos\UpdateUserDto;
use App\Application\UseCases\Interfaces\UpdateUserUseCaseInterface;
use App\Domain\Ports\Services\UserServiceInterface;

class UpdateUserUseCase implements UpdateUserUseCaseInterface {
    private UserServiceInterface $_userService;
    public function __construct(UserServiceInterface $userService)
    {
        $this->_userService = $userService;
    }

    public function execute(string $id, UpdateUserDto $updateUserDto): bool {
        $userModel = $updateUserDto->toModel($updateUserDto);
        $save = $this->_userService->updateUser($id, $userModel);
        return (!$save);
    }
}