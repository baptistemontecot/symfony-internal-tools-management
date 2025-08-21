<?php

namespace App\Controller\Api;

use App\Entity\Tool;
use App\Repository\ToolRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class ToolsController extends AbstractController
{
    public function __construct(private ToolRepository $toolRepository)
    {
    }

    #[Route('/api/tools', name: 'api_tools', methods: ['GET'])]
    public function getTools(EntityManagerInterface $em): JsonResponse
    {
        $tools = $this->toolRepository->findAll();

        return $this->json([
            'data' => array_map([$this, 'serializeTool'], $tools)
        ]);

//        return $this->json([
//            'id' => $toolRepository->getId(),
//            'name' => $toolRepository->getName(),
//            'created_at' => $toolRepository->getCreatedAt()?->format('c'),
//            'updated_at' => $toolRepository->getUpdatedAt()?->format('c')
//        ]);
    }

    private function serializeTool($tool): array
    {
        return [
            'id' => $tool->getId(),
            'name' => $tool->getName(),
            'description' => $tool->getDescription(),
            'vendor' => $tool->getVendor(),
            'category' => $tool->getCategoryId()?->getName(),
            'monthly_cost' => (float) $tool->getMonthlyCost(),
            'owner_department' => $tool->getOwnerDepartment(),
            'status' => $tool->getStatus(),
            'website_url' => $tool->getWebsiteUrl(),
            'active_users_count' => $tool->getActiveUsersCount(),
            'created_at' => $tool->getCreatedAt()?->format('Y-m-d\TH:i:s\Z'),
        ];
    }

//    #[Route('/api/tools/{id}', name: 'api_tools_id', methods: ['GET'])]
//    public function show(Tool $tool): JsonResponse
//    {
//        return $this->json($this->serializeTool($tool));
//    }
//
//    private function serializeTool(Tool $tool): array
//    {
//        return [
//            'id' => $tool->getId(),
//            'name' => $tool->getName()
//        ];
//    }
}
