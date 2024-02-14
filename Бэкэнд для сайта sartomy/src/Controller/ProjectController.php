<?php

namespace App\Controller;

use App\Entity\Project;
use App\Repository\ProjectRepository;
use App\Repository\UserTokenRepository;
use App\Service\Tool\SecurityToken;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends BaseController
{
    #[Route('/project/create', name: 'app_project_create')]
    public function create
    (
        Request $request,
        ProjectRepository $projectRepository,
    ): JsonResponse
    {
        $data = $request->toArray();
        if(!$this->securityService->auth($data['token'])) return $this->createAuthError();

        if($projectRepository->findOneBy(['title' => $data['title']])) return $this->createBadRequestResponse(false, 'This project already exists');

        $project = new Project($data);

        if($this->errorCount($project)) return $this->createBadRequestResponse($project);

        $projectRepository->save($project, true);

        return $this->json([]);
    }
    #[Route('/project/{id}/edit', name:'app_project_edit')]
    public function edit
    (
        Request $request,
        ProjectRepository $repository,
        $id
    )
    {
        $data = $request->toArray();

        if(!$this->securityService->auth($data['token'])) return $this->createAuthError();

        $project = $repository->find($id);

        if(!$project) return $this->createNotFoundResponse('Project not found');

        if($repository->findOneBy(['title' => $data['title']]))
            return $this->json(['message' => 'Project name already used'], Response::HTTP_BAD_REQUEST);

        $project->setTitle($data['title']);

        if($this->errorCount($project)) return $this->createBadRequestResponse($project);

        $repository->save($project, true);

        return $this->json([]);
    }
    #[Route('/project/{id}/remove', name: 'app_remove_project')]
    public function remove
    (
        Request $request,
        ProjectRepository $repository,
        $id
    )
    {
        $data = $request->toArray();
        if(!$this->securityService->auth($data['token'])) return $this->createAuthError();

        $project = $repository->find($id);

        if(!$project) return $this->createNotFoundResponse('Project not found');

        $repository->remove($project, true);

        return $this->json([]);
    }

    #[Route('/project/get', name: 'app_get_projects')]
    public function get
    (
        Request $request,
        ProjectRepository $repository,
    )
    {
        $data = $request->toArray();
        if(!$this->securityService->auth($data['token'])) return $this->json([], Response::HTTP_FORBIDDEN);

        $projects = $repository->findAll();

        $out = [];
        foreach ($projects as $project) {
            $out[] = [
                'id' => $project->getId(),
                'title' => $project->getTitle(),
                'parent_id' => $project->getParentId() ?? null
            ];
        }

        return $this->json($out);
    }

}
