<?php

namespace App\Service\Tool;

use App\Repository\UserTokenRepository;

class SecurityService
{
    private UserTokenRepository $userTokenRepository;

    public function __construct(
        UserTokenRepository $userTokenRepository
    )
    {
        $this->userTokenRepository = $userTokenRepository;
    }


    public function superAdminAuth($requestToken, $securityToken): bool
    {
        return $requestToken == $securityToken;
    }

    public function auth(
        $requestToken
    )
    {
        $token = $this->userTokenRepository->findOneBy(['token' => $requestToken, 'isActive' => true]);

        if(!$token) return false;

        if($token->getActiveUntil() < new \DateTimeImmutable()) {
            $token->setIsActive(false);
            $this->userTokenRepository->save($token, true);

            return false;
        }

        return true;
    }
}