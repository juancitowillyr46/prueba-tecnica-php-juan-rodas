<?php 
namespace App\Infrastructure\Api\Controllers;

use App\Application\Dtos\CreateUserDto;
use App\Application\Dtos\UpdateUserDto;
use App\Application\UseCases\Interfaces\CreateUserUseCaseInterface;
use App\Application\UseCases\Interfaces\DeleteUserUseCaseInterface;
use App\Application\UseCases\Interfaces\GetAllUserUseCaseInterface;
use App\Application\UseCases\Interfaces\GetByIdUserUseCaseInterface;
use App\Application\UseCases\Interfaces\UpdateUserUseCaseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Http\Response;

class UserController {
    private CreateUserUseCaseInterface $createUserUseCase;
    private UpdateUserUseCaseInterface $updateUserUseCase;
    private GetByIdUserUseCaseInterface $getByIdUserUseCase;
    private DeleteUserUseCaseInterface $deleteUserUseCase;
    private GetAllUserUseCaseInterface $getAllUserUseCase;

    public function __construct(
        CreateUserUseCaseInterface $createUserUseCase, 
        UpdateUserUseCaseInterface $updateUserUseCase, 
        GetByIdUserUseCaseInterface $getByIdUserUseCase, 
        DeleteUserUseCaseInterface $deleteUserUseCase,
        GetAllUserUseCaseInterface $getAllUserUseCase)
    {
        $this->createUserUseCase = $createUserUseCase;
        $this->updateUserUseCase = $updateUserUseCase;
        $this->getByIdUserUseCase = $getByIdUserUseCase;
        $this->deleteUserUseCase = $deleteUserUseCase;
        $this->getAllUserUseCase = $getAllUserUseCase;
    }

    public function create(Request $request, Response $response, $args): Response {
        $request = $request->getParsedBody();
        $createDto = new CreateUserDto();
        $createDto->fullName = $request['fullName'];
        $createDto->email = $request['email'];
        $createDto->password = $request['password'];
        $result = $this->createUserUseCase->execute($createDto);
        return $response->withJson(['data' => $result]);
    }

    public function update(Request $request, Response $response, $args = []): Response {
        $id = $args['userId'];
        $updateDto = new UpdateUserDto();
        $updateDto->fullName = $request['firstName'];
        $updateDto->email = $request['email'];
        $updateDto->password = $request['password'];
        $result = $this->updateUserUseCase->execute($id, $updateDto);
        return $response->withJson(['data' => $result]);
    }

    public function getById(Request $request, Response $response, $args = []): Response {
        $id = $args['userId'];
        $result = $this->getByIdUserUseCase->execute($id);
        return $response->withJson(['data' => $result]);
    }

    public function delete(Request $request, Response $response, $args = []): Response {
        $id = $args['userId'];
        $result = $this->deleteUserUseCase->execute($id);
        return $response->withJson(['data' => $result]);
    }

    public function getAll(Request $request, Response $response, $args = []): Response {
        $result = $this->getAllUserUseCase->execute();
        return $response->withJson(['data' => $result]);
    }
}