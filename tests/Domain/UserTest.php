<?php 
use App\Domain\Models\UserModel;
use App\Infrastructure\Database\Entities\UserEntity;
use PHPUnit\Framework\TestCase;
class UserTest extends TestCase {
    public function testUserEntity() {
        $objUser = new UserEntity();
        $objUser->setFullName("Juan Rodas");
        $objUser->setEmail("juan.rodas.manez@gmail.com");
        $objUser->setPassword("password123");
        $this->assertInstanceOf(UserEntity::class, $objUser);
    }

    public function testUserModel() {
        $objUser = new UserModel();
        $objUser->setFullName("Juan Rodas");
        $objUser->setEmail("juan.rodas.manez@gmail.com");
        $objUser->setPassword("password123");
        $this->assertInstanceOf(UserModel::class, $objUser);
    }
}