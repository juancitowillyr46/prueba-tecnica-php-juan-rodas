<?php 
namespace App\Application\UseCases\Interfaces;

use App\Application\Dtos\GetUserDto;

interface GetAllUserUseCaseInterface {
    public function execute(): ?array;
}