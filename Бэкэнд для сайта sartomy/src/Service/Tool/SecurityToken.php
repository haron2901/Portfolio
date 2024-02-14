<?php
namespace App\Service\Tool;

use App\Repository\UserTokenRepository;
use Symfony\Component\HttpFoundation\Response;

class SecurityToken
{
    public function isTokenValidate
    (
        $token,
        UserTokenRepository $repository,
    )
    {
        if(!$repository->findOneBy(['token' => $token])) return null;
        if($repository->findOneBy(['token' => $token])->getActiveUntil() < new \DateTimeImmutable()) return null;
        return Response::HTTP_OK;
    }
}