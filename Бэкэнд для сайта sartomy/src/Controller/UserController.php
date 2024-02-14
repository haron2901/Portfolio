<?php

namespace App\Controller;

use App\Entity\UserToken;
use App\Repository\UserRepository;
use App\Repository\UserTokenRepository;
use DateInterval;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use function Sodium\add;


class UserController extends BaseController
{
    #[Route('/user/create', name: 'app_user_create')]
    public function create(
        Request $request,
        UserRepository $repository,
    ): JsonResponse
    {
        $data = $request->toArray();

        $user = new User($data);

        if($this->errorCount($user)) return $this->createBadRequestResponse($user);

        if(!$this->securityService->superAdminAuth($data['security_token'], $this->securityToken))
            return $this->createAuthError();

        $repository->save($user, true);

        return $this->json([]);
    }
    #[Route('/user/auth', name: 'app_user_auth')]
    public function auth
    (
        Request $request,
        UserRepository $userRepository,
        UserTokenRepository $userTokenRepository,
    )
    {
        $data = $request->toArray();

        $user = $userRepository->findOneBy(['email' => $data['email']]);
        if(!$user) return $this->createAuthError();

        $passwordsMatch = password_verify($data['password'], $user->getPassword());
        if (!$passwordsMatch) return $this->createAuthError();

        $tokens = $userTokenRepository->findBy(['userId' => $user->getId(), 'isActive' => true]);

        foreach ($tokens as $token) {
            $token->setIsActive(false);
            $userTokenRepository->save($token, true);
        }

        $token = new UserToken($user->getId());
        if($this->errorCount($token)) return $this->createBadRequestResponse($token);
        $userTokenRepository->save($token, true);

        return $this->json(
            [
            'token' => $token->getToken(),
            "name" => $user->getName(),
            "surname" => $user->getSurname()
            ]
        );
    }
    #[Route('/user/token', name: 'sign_up_with_token')]
    public function authByToken
    (
        Request $request,
        UserRepository $userRepository,
        UserTokenRepository $userTokenRepository
    )
    {
        $data = $request->toArray();

        $token = $userTokenRepository->findOneBy(['token' => $data['token'], 'isActive' => true]);

        if(!$token) return $this->createAuthError();

        if($token->getActiveUntil() < new \DateTimeImmutable()) {
            $token->setIsActive(false);
            $token = false;
        }

        if($token){
            $user = $userRepository->find($token->getUserId());

            return $this->json([
                'name' => $user->getName(),
                'surname' => $user->getSurname()
            ]);
        }

        return $this->createAuthError();
    }
    #[Route('/user/logout', name:'logout_user')]
    public function logout
    (
        Request $request,
        UserTokenRepository $repository
    )
    {
        $data = $request->toArray();

        $userToken = $repository->findOneBy(['token' => $data['token']]);

        if(!$userToken) goto end;

        $userToken->setIsActive(false);
        $repository->save($userToken, true);

        end:
        return $this->json([]);
    }
}
