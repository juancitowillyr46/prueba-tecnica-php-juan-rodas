<?php

use App\Application\Services\UserService;
use App\Application\UseCases\CreateUserUseCase;
use App\Application\UseCases\DeleteUserUseCase;
use App\Application\UseCases\GetAllUserUseCase;
use App\Application\UseCases\GetByIdUserUseCase;
use App\Application\UseCases\Interfaces\CreateUserUseCaseInterface;
use App\Application\UseCases\Interfaces\DeleteUserUseCaseInterface;
use App\Application\UseCases\Interfaces\GetAllUserUseCaseInterface;
use App\Application\UseCases\Interfaces\GetByIdUserUseCaseInterface;
use App\Application\UseCases\Interfaces\UpdateUserUseCaseInterface;
use App\Application\UseCases\UpdateUserUseCase;
use App\Domain\Ports\Repositories\DBConnectionInterface;
use App\Domain\Ports\Repositories\UserRepositoryInterface;
use App\Domain\Ports\Services\UserServiceInterface;
use App\Infrastructure\Api\Controllers\UserController;
use App\Infrastructure\Database\MySQMySqlConnection;
use DI\Container;
use Psr\Container\ContainerInterface;
use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use App\Infrastructure\Database\Persistence\UserRepository;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Routing\RouteCollectorProxy;

require __DIR__ . '/../vendor/autoload.php';

// Injection Dependency
$container = new Container();

$container->set(UserRepositoryInterface::class, function (ContainerInterface $container) {
    return new UserRepository();
});

$container->set(UserServiceInterface::class, function (ContainerInterface $container) {
    $repository = $container->get(UserRepositoryInterface::class);
    return new UserService($repository);
});

$container->set(CreateUserUseCaseInterface::class, function (ContainerInterface $container) {
    $service = $container->get(UserServiceInterface::class);
    return new CreateUserUseCase($service);
});

$container->set(UpdateUserUseCaseInterface::class, function (ContainerInterface $container) {
    $service = $container->get(UserServiceInterface::class);
    return new UpdateUserUseCase($service);
});

$container->set(DeleteUserUseCaseInterface::class, function (ContainerInterface $container) {
    $service = $container->get(UserServiceInterface::class);
    return new DeleteUserUseCase($service);
});

$container->set(GetByIdUserUseCaseInterface::class, function (ContainerInterface $container) {
    $service = $container->get(UserServiceInterface::class);
    return new GetByIdUserUseCase($service);
});

$container->set(GetAllUserUseCaseInterface::class, function (ContainerInterface $container) {
    $service = $container->get(UserServiceInterface::class);
    return new GetAllUserUseCase($service);
});


$app = AppFactory::createFromContainer($container);

// Middlewares
$app->addBodyParsingMiddleware();
$app->addRoutingMiddleware();
$errorMiddleware = $app->addErrorMiddleware(true, true, true);

// Routes
$app->group('/api', function (RouteCollectorProxy $group) {
    $group->group('/users', function (RouteCollectorProxy $group) {
        $group->get('', UserController::class . ':getAll');
        $group->post('', UserController::class . ':create');
        $group->put('/{userId}', UserController::class . ':update');
        $group->delete('/{userId}', UserController::class . ':delete');
        $group->get('/{userId}', UserController::class . ':getById');
    });
});

// Run app
$app->run();