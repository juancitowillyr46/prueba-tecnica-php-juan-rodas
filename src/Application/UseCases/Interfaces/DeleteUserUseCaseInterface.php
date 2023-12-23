<?php 
namespace App\Application\UseCases\Interfaces;

interface DeleteUserUseCaseInterface {
    public function execute(string $id): bool;
}