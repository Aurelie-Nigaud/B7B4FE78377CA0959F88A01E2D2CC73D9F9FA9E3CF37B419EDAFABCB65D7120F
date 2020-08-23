<?php

namespace App\Service\Student;

use App\Entity\Classroom;
use App\Entity\Grade;
use App\Entity\Student;
use App\Entity\Subject;
use App\Repository\Classroom\ClassroomRepositoryInterface;
use App\Repository\Student\StudentRepositoryInterface;
use App\Service\ServiceResponse;
use App\Service\Student\AddStudentGradeService\Dto\AddStudentGradeDTO;
use App\Service\Student\CreateStudentService\Dto\CreateStudentDTO;
use App\Service\Student\GetStudentGlobalAvgService\Dto\StudentGlobalAverageDTO;
use App\Service\Student\UpdateStudentService\Dto\UpdateStudentDTO;
use AutoMapperPlus\AutoMapperInterface;
use AutoMapperPlus\Exception\UnregisteredMappingException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class StudentService
 * @package App\Service\Student
 */
class StudentService implements StudentServiceInterface
{
    /**
     * @var StudentRepositoryInterface
     */
    private $studentRepository;

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
     * StudentService constructor.
     * @param StudentRepositoryInterface $studentRepository
     * @param ClassroomRepositoryInterface $classroomRepositoty
     * @param ValidatorInterface $validator
     * @param EntityManagerInterface $entityManager
     * @param AutoMapperInterface $mapper
     */
    public function __construct(
        StudentRepositoryInterface $studentRepository,
        ValidatorInterface $validator,
        EntityManagerInterface $entityManager,
        AutoMapperInterface $mapper)
    {
        $this->studentRepository = $studentRepository;
        $this->validator = $validator;
        $this->entityManager = $entityManager;
        $this->mapper = $mapper;
    }

    /**
     * @param CreateStudentDTO $studentDTO
     * @return int
     */
    public function createStudent(CreateStudentDTO $studentDTO): ServiceResponse
    {
        /**@var Student $student */
        $student = $this->mapper->mapToObject($studentDTO, new Student());
        /**@Var ConstraintViolationList $constraintsViolationlist */
        $constraintsViolationlist = $this->validator->validate($student, null, "create");

        if (!is_null($studentDTO->getClassroom())) {
            $student->setClassroom($this->entityManager->find(Classroom::class, $studentDTO->getClassroom()));
        }
        if ($constraintsViolationlist->count() === 0) {
            $this->entityManager->persist($student);
            $this->entityManager->flush();
        }
        return new ServiceResponse($student->getId(), $constraintsViolationlist);
    }

    /**
     * @param int $id
     * @param UpdateStudentDTO $studentDTO
     * @return ServiceResponse
     * @throws UnregisteredMappingException
     */
    public function updateStudent(int $id, UpdateStudentDTO $studentDTO): ServiceResponse
    {

        $student = $this->mapper->mapToObject(
            $studentDTO,
            $this->entityManager->find(Student::class, $id));

        /**@Var ConstraintViolationList $constraintsViolationlist */
        $constraintsViolationlist = $this->validator->validate($student, null, "update");

        if (!is_null($student)) {
            if ($constraintsViolationlist->count() === 0) {
                $this->entityManager->persist($student);
                $this->entityManager->flush();
            }
        }

        return new ServiceResponse($student->getId(), $constraintsViolationlist);
    }

    /**
     * @param int $id
     * @return StudentGlobalAverageDTO
     */
    public function getStudentGlobalGrade(int $id): ServiceResponse
    {
        /** @var Student $student */
        $student = $this->studentRepository->getStudentGlobalGrade($id);
        return new ServiceResponse($student->getGlobalAvg());
    }

    /**
     * @param int $id
     */
    public function removeStudent(int $id): ServiceResponse
    {
        /**@var Student $student */
        $student = $this->entityManager->find(Student::class, $id);

        if (!is_null($student)) {
            $this->entityManager->remove($student);
            $this->entityManager->flush();
        }

        return new ServiceResponse('delete is done', null, $student->getId());
    }

    /**
     * @param int $id
     * @param int $value
     * @return ServiceResponse
     */
    public function addStudentGrade(int $id, AddStudentGradeDTO $gradeDTO): ServiceResponse
    {
        /**@var Grade $grade */
        $grade = $this->mapper->mapToObject($gradeDTO, new Grade());
        $grade->setSubject(
            $this->entityManager->find(Subject::class, $gradeDTO->getSubject()));
        $grade->addStudent(
            $this->entityManager->find(Student::class, $id));

        /**@Var ConstraintViolationList $constraintsViolationlist */
        $constraintsViolationlist = $this->validator->validate($grade, null, "add");

        if ($constraintsViolationlist->count() === 0) {
            $this->entityManager->persist($grade);
            $this->entityManager->flush();
        }
        return new ServiceResponse($grade->getId(), $constraintsViolationlist);
    }
}