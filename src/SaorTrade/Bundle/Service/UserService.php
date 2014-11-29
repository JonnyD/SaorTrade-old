<?php

namespace SaorTrade\Bundle\Service;

use SaorTrade\Bundle\Repository\UserRepository;
use SaorTrade\Bundle\Entity\User;

class UserService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function registerUser(User $user)
    {
        $this->userRepository->save($user);
    }
}