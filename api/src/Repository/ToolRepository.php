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

    public function paginateTools(int $page, int $limit): PaginationInterface
    {
        return $this->paginator->paginate(
            $this->createQueryBuilder('t'),
            $page,
            $limit
        );
    }
}
