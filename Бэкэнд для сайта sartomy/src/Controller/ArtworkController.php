<?php

namespace App\Controller;

use App\Controller\BaseController;
use App\Entity\Artwork;
use App\Repository\ArtworkRepository;
use App\Repository\ProjectRepository;
use App\Repository\UserTokenRepository;
use App\Service\Tool\SecurityToken;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArtworkController extends BaseController
{
    #[Route('/artwork/create', name: 'app_artwork_create')]
    public function create
    (
        Request $request,
        ArtworkRepository $repository,
        ProjectRepository $projectRepository
    ): JsonResponse
    {
        $data = $request->toArray();
        if(!$this->securityService->auth($data['token'])) return $this->createAuthError();

        if($repository->findOneBy(['title' => $data['title'], 'projectId' => $data['project_id']]))
            return $this->createBadRequestResponse();

        if(!$projectRepository->find($data['project_id']))
            return $this->createNotFoundResponse();

        $artwork = new Artwork($data);
        if($this->errorCount($artwork)) return $this->createBadRequestResponse($artwork);

        $repository->save($artwork, true);

        return $this->json([]);
    }
#[Route('/artwork/{id}/move', name: 'app_artwork_move')]
    public function move
    (
        Request $request,
        ArtworkRepository $repository,
        ProjectRepository $projectRepository,
        $id
    ): JsonResponse
    {
        $data = $request->toArray();

        if(!$this->securityService->auth($data['token'])) return $this->createAuthError();

        if(!$projectRepository->find($data['project_id'])) return $this->createBadRequestResponse();

        $artwork = $repository->find($id);

        if(!$artwork) return $this->createNotFoundResponse('Artwork not found');

        if($repository->findOneBy(['title' => $artwork->getTitle(), 'projectId' => $data['project_id']])) {
            return $this->createBadRequestResponse(false, 'Artwork with this name already exists in project');
        }

        $artwork->setProjectId($data['project_id']);
        $repository->save($artwork, true);

        return $this->json([]);
    }
    #[Route('/artwork/{id}/remove', name: 'app_artwork_remove')]
    public function remove
    (
        Request $request,
        ArtworkRepository $repository,
        $id
    )
    {
        $data = $request->toArray();

        if(!$this->securityService->auth($data['token'])) return $this->createAuthError();

        $artwork = $repository->find($id);

        if(!$artwork) return $this->createNotFoundResponse('Artwork not found');

        $repository->remove($artwork, true);

        return $this->json([]);
    }
}
