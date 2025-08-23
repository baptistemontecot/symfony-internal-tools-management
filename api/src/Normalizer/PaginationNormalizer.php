<?php

namespace App\Normalizer;


use App\Entity\Tool;
use OpenApi\Annotations as OA;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * @OA\Schema(
 *   schema="PaginatedToolsResponse",
 *   type="object",
 *   @OA\Property(
 *     property="data",
 *     type="array",
 *     description="Liste d'outils paginée",
 *     @OA\Items(ref="#/components/schemas/Tool")
 *   ),
 *   @OA\Property(
 *     property="total",
 *     type="integer",
 *     description="Nombre total d'éléments disponibles"
 *   ),
 *   @OA\Property(
 *     property="page",
 *     type="integer",
 *     description="Numéro de la page courante"
 *   ),
 *   @OA\Property(
 *     property="lastPage",
 *     type="integer",
 *     description="Numéro de la dernière page"
 *   )
 * )
 */
readonly class PaginationNormalizer implements NormalizerInterface
{
    public function __construct(
        #[Autowire(service: 'serializer.normalizer.object')]
        private NormalizerInterface $normalizer
    )
    {

    }

    public function normalize(mixed $data, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        if (!$data instanceof PaginationInterface) {
            throw new \RuntimeException();
        }

        return [
            'data' => array_map(fn(Tool $tool) => $this->normalizer->normalize($tool, $format, $context), $data->getItems()),
            'total' => $data->getTotalItemCount(),
            'page' => $data->getCurrentPageNumber(),
            'lastPage' => ceil($data->getTotalItemCount() / $data->getItemNumberPerPage()),
        ];
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return $data instanceof PaginationInterface && $format === 'json';
    }

    public function getSupportedTypes(?string $format): array
    {
        return [
            PaginationInterface::class => true
        ];
    }
}
