<?php 
namespace App\Application\UseCases;

use App\Application\UseCases\Interfaces\GetAllUserUseCaseInterface;
use App\Domain\Ports\Services\UserServiceInterface;

class GetAllUserUseCase implements GetAllUserUseCaseInterface {
    private UserServiceInterface $_userService;
    public function __construct(UserServiceInterface $userService)
    {
        $this->_userService = $userService;
    }

    public function execute(): ?array {
        return $this->_userService->getAll();
    }
}