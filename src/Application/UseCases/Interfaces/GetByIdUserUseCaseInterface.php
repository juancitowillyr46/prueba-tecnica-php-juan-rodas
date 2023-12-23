<?php 
namespace App\Application\UseCases\Interfaces;

use App\Application\Dtos\GetUserDto;

interface GetByIdUserUseCaseInterface {
    public function execute(string $id): ?GetUserDto;
}