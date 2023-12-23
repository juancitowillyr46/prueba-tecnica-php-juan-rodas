<?php 
namespace App\Application\UseCases;

use App\Application\Dtos\CreateUserDto;
use App\Application\UseCases\Interfaces\CreateUserUseCaseInterface;
use App\Domain\Ports\Services\UserServiceInterface;

class CreateUserUseCase implements CreateUserUseCaseInterface {
    private UserServiceInterface $_userService;
    public function __construct(UserServiceInterface $userService)
    {
        $this->_userService = $userService;
    }

    public function execute(CreateUserDto $createUserDto): bool {
        $userModel = $createUserDto->toModel($createUserDto);
        $save = $this->_userService->saveUser($userModel);
        return ($save != null);
    }
}