<?php

namespace App\Repository\Student;

use App\Entity\Student;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class StudentRepository
 * @package App\Repository\Student
 */
final class StudentRepository extends ServiceEntityRepository implements StudentRepositoryInterface
{
    /**
     * @param ManagerRegistry $managerRegistry
     */
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, Student::class);
    }

    /**
     * @param int $studentId
     * @return Student
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function getStudentGlobalGrade(int $studentId): Student
    {
        $query = $this->createQueryBuilder('stu');
        $query->innerJoin('stu.grades', 'gra')
            ->addSelect('gra')
            ->where($query->expr()->eq('stu.id', ':StudentId'))
            ->setParameter('StudentId', "$studentId");

        return $query->getQuery()->getSingleResult();
    }
}