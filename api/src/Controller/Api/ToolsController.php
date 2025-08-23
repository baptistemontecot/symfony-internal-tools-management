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
     *     summary="Liste paginée des outils disponibles",
     *     @OA\Parameter(
     *           name="department",
     *           in="query",
     *           description="Département propriétaire",
     *           required=false,
     *           @OA\Schema(type="string")
     *       ),
     *     @OA\Parameter(
     *           name="status",
     *           in="query",
     *           description="Status de l'abonnement à l'outil",
     *           required=false,
     *           @OA\Schema(type="string")
     *       ),
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Numéro de la page consultée",
     *         required=false,
     *         @OA\Schema(type="integer", default=1)
     *     ),
     *     @OA\Parameter(
     *          name="limit",
     *          in="query",
     *          description="Nombre d'éléments par page",
     *          required=false,
     *          @OA\Schema(type="integer", default=5)
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="Réponse paginée avec la liste des outils",
     *          @OA\JsonContent(ref="#/components/schemas/PaginatedToolsResponse")
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Paramètres invalides"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Aucun outil trouvé"
     *      )
     * )
     */
    #[Route('/api/tools', name: 'api_tools', methods: ['GET'])]
    public function index(ToolRepository $repository, Request $request): JsonResponse
    {
        $filters = [
            'department' => $request->query->get('department'),
            'status' => $request->query->get('status'),
        ];

        if ($minCost = $request->query->get('min_cost')) {
            $filters['min_cost'] = (float)$minCost;
        }
        if ($maxCost = $request->query->get('max_cost')) {
            $filters['max_cost'] = (float)$maxCost;
        }
        if ($category = $request->query->get('category')) {
            $filters['category'] = $category;
        }

        $tools = $repository->paginateTools(
            $filters,
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
     *         @OA\Schema(type="integer", default="1")
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
