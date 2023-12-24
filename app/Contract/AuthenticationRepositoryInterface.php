<?php


namespace App\Contract;

use App\Models\User;

interface AuthenticationRepositoryInterface
{
    public function login(array $data);

    public function register(array $data);
}
