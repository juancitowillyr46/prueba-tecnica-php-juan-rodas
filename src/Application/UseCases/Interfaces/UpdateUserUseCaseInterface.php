<?php 
namespace App\Application\UseCases\Interfaces;

use App\Application\Dtos\CreateUserDto;
use App\Application\Dtos\UpdateUserDto;

interface UpdateUserUseCaseInterface {
    public function execute(string $id, UpdateUserDto $updateUserDto): bool;
}