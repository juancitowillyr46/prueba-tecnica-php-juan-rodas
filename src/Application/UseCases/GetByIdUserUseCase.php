<?php 
namespace App\Application\UseCases;

use App\Application\Dtos\GetUserDto;
use App\Application\Dtos\UpdateUserDto;
use App\Application\UseCases\Interfaces\GetByIdUserUseCaseInterface;
use App\Domain\Ports\Services\UserServiceInterface;

class GetByIdUserUseCase implements GetByIdUserUseCaseInterface {
    private UserServiceInterface $_userService;
    public function __construct(UserServiceInterface $userService)
    {
        $this->_userService = $userService;
    }

    public function execute(string $id): ?GetUserDto {
        $model = $this->_userService->getById($id);
        if($model){ 
            $getUserDto = new GetUserDto();
            $getUserDto->fullName = $model->getFullName();
            $getUserDto->email = $model->getEmail();
            $getUserDto->password = $model->getPassword();
        }
        return ($model)? $getUserDto : null;
    }
}