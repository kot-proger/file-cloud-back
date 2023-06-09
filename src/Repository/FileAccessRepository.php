<?php

namespace App\Repository;

use App\Entity\FileAccess;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FileAccess>
 *
 * @method FileAccess|null find($id, $lockMode = null, $lockVersion = null)
 * @method FileAccess|null findOneBy(array $criteria, array $orderBy = null)
 * @method FileAccess[]    findAll()
 * @method FileAccess[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FileAccessRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FileAccess::class);
    }

    public function save(FileAccess $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(FileAccess $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
