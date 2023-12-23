<?php 
namespace App\Application\UseCases\Interfaces;

use App\Application\Dtos\CreateUserDto;

interface CreateUserUseCaseInterface {
    public function execute(CreateUserDto $createUserDto): bool;
}