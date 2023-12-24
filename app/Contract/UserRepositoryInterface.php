<?php


namespace App\Contract;

use App\Models\Product;

interface UserRepositoryInterface
{
    public function getAllUsers();

    public function getUserById(int $userId);

    public function createUser(array $attributes);

    public function updateUser(array $attributes, int $userId);

    public function deleteUser(int $userId);

}
