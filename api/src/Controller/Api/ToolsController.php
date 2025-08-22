<?php

namespace App\Controller\Api;

use App\Entity\Tool;

use OpenApi\Annotations as OA;
use App\Repository\ToolRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Requirement\Requirement;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @OA\Info(title="API Internal Tools Management", version="1.0")
 * @OA\Server(
 *      url="http://localhost:8000/api",
 *      description="API de gestion des outils internes"
 *  )
 */
final class ToolsController extends AbstractController
{
    /**
     * @OA\Get(
     *     path="/tools",
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Le numéro de la page consultée",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     responses={
     *         @OA\Response(
     *             response="200",
     *             description="Nos outils",
     *             @OA\JsonContent(
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/Tool")
     *             )
     *         )
     *     }
     * )
     */
    #[Route('/api/tools', name: 'api_tools', methods: ['GET'])]
    public function index(ToolRepository $repository, Request $request): JsonResponse
    {
        $tools = $repository->paginateTools(
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 5)
        );

        return $this->json($tools, 200, [], [
            'groups' => ['tools.index']
        ]);
    }

    /**
     * @OA\Get(
     *     path="/tools/{id}",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de notre outil",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     responses={
     *         @OA\Response(
     *             response="200",
     *             description="Notre outil",
     *             @OA\JsonContent(
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/Tool")
     *             )
     *         )
     *     }
     * )
     */
    #[Route('/api/tools/{id}', name: 'api_tools_id', requirements: ['id' => Requirement::DIGITS], methods: ['GET'])]
    public function show(Tool $tool): JsonResponse
    {
        return $this->json($tool, 200, [], [
            'groups' => ['tools.index', 'tools.show']
        ]);
    }
}
