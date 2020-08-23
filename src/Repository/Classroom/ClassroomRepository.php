<?php

namespace App\Repository\Classroom;

use App\Entity\Classroom;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class ClassroomRepository
 * @package App\Repository\Classroom
 */
class ClassroomRepository extends ServiceEntityRepository implements ClassroomRepositoryInterface
{
    /**
     * @param ManagerRegistry $managerRegistry
     */
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, Classroom::class);
    }

    /**
     * @param int $id
     * @return Classroom
     */
    public function getClassroomGlobalGrades(int $id): Classroom
    {
        $query = $this->createQueryBuilder('cla');
        $query->innerJoin('cla.grades', 'gra')
            ->addSelect('gra')
            ->where($query->expr()->eq('cla.id', ':ClassroomId'))
            ->setParameter('ClassroomId', "$id");

        return $query->getQuery()->getSingleResult();
    }
}