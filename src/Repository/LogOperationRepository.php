<?php

namespace App\Repository;

use App\Entity\LogOperation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LogOperation>
 *
 * @method LogOperation|null find($id, $lockMode = null, $lockVersion = null)
 * @method LogOperation|null findOneBy(array $criteria, array $orderBy = null)
 * @method LogOperation[]    findAll()
 * @method LogOperation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LogOperationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LogOperation::class);
    }

    public function save(LogOperation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(LogOperation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
