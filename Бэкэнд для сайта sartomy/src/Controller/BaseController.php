<?php

namespace App\Controller;

use App\Service\Tool\SecurityService;
use App\Service\Tool\Validator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class BaseController extends AbstractController
{
    protected EntityManagerInterface $em;
    protected Validator $validator;
    protected mixed $securityToken;
    protected SecurityService $securityService;

    public function __construct(
        Validator $validator,
        EntityManagerInterface $entityManager,
        SecurityService $securityService,
        $securityToken
    )
    {
        $this->validator = $validator;
        $this->em = $entityManager;
        $this->securityService = $securityService;
        $this->securityToken = $securityToken;
    }

    public function errorCount($entity): int
    {
        return $this->validator->count($entity);
    }

    public function createBadRequestResponse($entity = false, $message = false): JsonResponse
    {
        $env = $this->getParameter('kernel.environment');

        if(($env == 'dev' or $env == 'test') and $entity)
            $error = $this->validator->errors($entity);
        elseif($message)
            $error = $message;
        else
            $error = 'Bad request or entity already exists';

        return $this->json(['message' => $error], Response::HTTP_BAD_REQUEST);
    }

    public function createNotFoundResponse($message = false): JsonResponse
    {
        $env = $this->getParameter('kernel.environment');

        if($env == 'dev' or $env == 'test')
            $error = $message;
        else
            $error = "";

        return $this->json(['message' => $error], Response::HTTP_NOT_FOUND);
    }

    public function createAuthError(): JsonResponse
    {
        return $this->json([], Response::HTTP_FORBIDDEN);
    }
}