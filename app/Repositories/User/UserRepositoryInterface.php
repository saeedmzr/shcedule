<?php

namespace App\Repositories\User;

interface UserRepositoryInterface extends \App\Repositories\BaseRepositoryInterface
{
    public function LoginAdminByEmail(string  $email , string $password) ;
}
