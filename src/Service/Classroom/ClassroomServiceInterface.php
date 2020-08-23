<?php

namespace App\Service\Classroom;

use App\Service\ServiceResponse;

/**
 * Interface ClassroomServiceInterface
 * @package App\Service\Classroom
 */
interface ClassroomServiceInterface
{
    /**
     * @param int $id
     * @return ServiceResponse
     */
    public function getClassroomGlobalAVG(int $id): ServiceResponse;
}