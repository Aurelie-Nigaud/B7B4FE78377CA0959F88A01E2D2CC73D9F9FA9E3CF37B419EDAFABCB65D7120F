<?php

namespace App\Service\Student;

use App\Service\ServiceResponse;
use App\Service\Student\CreateStudentService\Dto\CreateStudentDTO;
use App\Service\Student\GetStudentGlobalAvgService\Dto\StudentGlobalAverageDTO;
use App\Service\Student\UpdateStudentService\Dto\UpdateStudentDTO;

/**
 * Interface StudentServiceInterface
 * @package App\Service
 */
interface StudentServiceInterface
{
    /**
     * @param CreateStudentDTO $studentDTO
     * @return ServiceResponse
     */
    public function createStudent(CreateStudentDTO $studentDTO): ServiceResponse;

    /**
     * @param int $id
     * @param UpdateStudentDTO $studentDTO
     * @return ServiceResponse
     */
    public function updateStudent(int $id, UpdateStudentDTO $studentDTO): ServiceResponse;

    /**
     * @param int $id
     * @return ServiceResponse
     */
    public function getStudentGlobalGrade(int $id): ServiceResponse;

    /**
     * @param int $id
     * @return ServiceResponse
     */
    public function removeStudent(int $id): ServiceResponse;
}