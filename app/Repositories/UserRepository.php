<?php

namespace App\Repositories;

class UserRepository {

    protected $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;

    }

}
