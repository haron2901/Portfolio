<?php

use App\Entity\User;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Config\SecurityConfig;

return static function (SecurityConfig $security) {

    $security->passwordHasher(User::class)
        ->algorithm('auto');


    $security->passwordHasher(PasswordAuthenticatedUserInterface::class)
        ->algorithm('auto')
        ->cost(15);
};

