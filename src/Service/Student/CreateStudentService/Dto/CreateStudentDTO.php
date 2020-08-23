<?php

namespace App\Service\Student\CreateStudentService\Dto;

use Swagger\Annotations as SWG;

/**
 * Class CreateStudentDTO
 * @package App\Service\Student\CreateStudentService\Dto
 */
class CreateStudentDTO
{
    /**
     * @var string
     * @SWG\Property(type="string", maxLength=100, minLength=3, example="Dupond")
     */
    public $lastname;

    /**
     * @var string
     * @SWG\Property(type="string", maxLength=100, minLength=3, example="Jean")
     */
    public $firstname;

    /**
     * @var ?String
     * @SWG\Property(type="string", description="dateTime iso8601", example="1990-02-15T00:00:00+00:00")
     */
    public $birthdate;

    /**
     * @var ?int
     * @SWG\Property(type="integer", description="classroom id", example="1")
     */
    public $classroom;

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @return String|null
     */
    public function getBirthdate(): ?string
    {
        return $this->birthdate;
    }

    /**
     * @return int|null
     */
    public function getClassroom(): ?int
    {
        return $this->classroom;
    }
}