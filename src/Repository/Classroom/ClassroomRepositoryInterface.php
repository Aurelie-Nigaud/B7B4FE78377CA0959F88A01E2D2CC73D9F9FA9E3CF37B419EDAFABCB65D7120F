<?php

namespace App\Repository\Classroom;

use App\Entity\Classroom;

interface ClassroomRepositoryInterface
{
    /**
     * @param int $id
     * @return Classroom
     */
    public function getClassroomGlobalGrades(int $id): Classroom;
}