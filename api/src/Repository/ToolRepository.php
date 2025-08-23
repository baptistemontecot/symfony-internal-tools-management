<?php

namespace App\Repository;

use App\Entity\Tool;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Tool>
 */
class ToolRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, private readonly PaginatorInterface $paginator)
    {
        parent::__construct($registry, Tool::class);
    }
    public function paginateTools(array $filters, int $page, int $limit): PaginationInterface
    {
        $qb = $this->createQueryBuilder('t');

        if (!empty($filters['department'])) {
            $qb->andWhere('t.owner_department = :department')
                ->setParameter('department', $filters['department']);
        }

        if (!empty($filters['status'])) {
            $qb->andWhere('t.status = :status')
                ->setParameter('status', $filters['status']);
        }

        if (isset($filters['min_cost'])) {
            $qb->andWhere('t.monthly_cost >= :minCost')
                ->setParameter('minCost', $filters['min_cost']);
        }
        if (isset($filters['max_cost'])) {
            $qb->andWhere('t.monthly_cost <= :maxCost')
                ->setParameter('maxCost', $filters['max_cost']);
        }
        if (isset($filters['category'])) {
            $qb->join('t.category_id', 'c')
                ->andWhere('c.name = :category')
                ->setParameter('category', $filters['category']);
        }

        return $this->paginator->paginate(
            $qb,
            $page,
            $limit
        );
    }
}
