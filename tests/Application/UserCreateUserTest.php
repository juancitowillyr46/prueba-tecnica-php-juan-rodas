<?php

use App\Application\Dtos\CreateUserDto;
use App\Application\Services\UserService;
use App\Application\UseCases\CreateUserUseCase;
use App\Application\UseCases\Interfaces\CreateUserUseCaseInterface;
use App\Domain\Models\UserModel;
use App\Domain\Ports\Repositories\UserRepositoryInterface;
use App\Domain\Ports\Services\UserServiceInterface;
use App\Infrastructure\Database\Entities\UserEntity;
use App\Infrastructure\Database\Persistence\UserRepository;
use PHPUnit\Framework\TestCase;
class UserCreateUserTest extends TestCase {
    public function testUserUseCaseCreateTest() {
        
        $repositoryMock = new UserRepository();
        $this->assertInstanceOf(UserRepositoryInterface::class, $repositoryMock);

        $userServiceMock = new UserService($repositoryMock);
        $this->assertInstanceOf(UserServiceInterface::class, $userServiceMock);
        
        $userCreateUserCaseMock = new CreateUserUseCase($userServiceMock);
        $this->assertInstanceOf(CreateUserUseCaseInterface::class, $userCreateUserCaseMock);

        $objUserDto = new CreateUserDto();
        $objUserDto->fullName = "Juan";
        $objUserDto->email = "juan.rodas.manez@gmail.com";
        $objUserDto->password = "pwd123";

        $response = $userCreateUserCaseMock->execute($objUserDto);
        $this->assertEquals($response, true);
    }
}