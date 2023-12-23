<?php 
use App\Domain\Models\UserModel;
use App\Domain\Ports\Repositories\UserRepositoryInterface;
use App\Infrastructure\Database\Entities\UserEntity;
use App\Infrastructure\Database\Persistence\UserRepository;
use PHPUnit\Framework\TestCase;
class UserRepositoryTest extends TestCase {
    public function testUserRepositoryCreateTest() {

        $objUserEntity = new UserEntity();
        $objUserEntity->setFullName("Juan");
        $objUserEntity->setEmail("juan.rodas.manez@gmail.com");
        $objUserEntity->setPassword("pwd123");

        $repository = new UserRepository();
        $response = $repository->saveUser($objUserEntity);
        $this->assertEquals($objUserEntity->getFullName(), $response->getFullName());
        $this->assertEquals($objUserEntity->getEmail(), $response->getEmail());
        $this->assertEquals($objUserEntity->getPassword(), $response->getPassword());
        $this->assertInstanceOf(UserRepositoryInterface::class, $repository);
    }
}