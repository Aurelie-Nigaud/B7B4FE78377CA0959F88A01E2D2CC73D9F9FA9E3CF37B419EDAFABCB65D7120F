<?php

namespace App\Service\Classroom;

use App\Repository\Classroom\ClassroomRepositoryInterface;
use App\Service\ServiceResponse;
use AutoMapperPlus\AutoMapperInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class ClassroomService
 * @package App\Service\Classroom
 */
class ClassroomService implements ClassroomServiceInterface
{

    /**
     * @var ClassroomRepositoryInterface
     */
    private $classroomRepository;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var AutoMapperInterface
     */
    private $mapper;

    /**
     * ClassroomService constructor.
     * @param ClassroomRepositoryInterface $classroomRepository
     * @param ValidatorInterface $validator
     * @param EntityManagerInterface $entityManager
     * @param AutoMapperInterface $mapper
     */
    public function __construct(
        ClassroomRepositoryInterface $classroomRepository,
        ValidatorInterface $validator,
        EntityManagerInterface $entityManager,
        AutoMapperInterface $mapper)
    {
        $this->classroomRepository = $classroomRepository;
        $this->validator = $validator;
        $this->entityManager = $entityManager;
        $this->mapper = $mapper;
    }

    public function getClassroomGlobalAVG(int $id): ServiceResponse    {
        $classroom = $this->classroomRepository->getClassroomGlobalGrades($id);
        return new ServiceResponse($classroom->getGlobalAvg(), null);
    }
}