<?php

namespace App\Repository\Student;

use App\Entity\Student;

/**
 * Interface StudentRepositoryInterface
 * @package App\Repository\Student
 */
interface StudentRepositoryInterface
{
    /**
     * @param int $studentId
     * @return Student
     */
    public function getStudentGlobalGrade(int $studentId): Student;
}