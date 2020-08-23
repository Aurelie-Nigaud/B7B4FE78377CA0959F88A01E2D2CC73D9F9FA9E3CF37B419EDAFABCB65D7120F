<?php

namespace App\Service\Student\UpdateStudentService\Dto;

use Swagger\Annotations as SWG;

/**
 * Class UpdateStudentDTO
 * @package App\Service\Student\UpdateStudentService\Dto
 */
class UpdateStudentDTO
{
    /**
     * @var string
     * @SWG\Property(type="string", maxLength=100, example="Doe")
     */
    public $lastname;

    /**
     * @var string
     * @SWG\Property(type="string", maxLength=100, example="John")
     */
    public $firstname;

    /**
     * @var ?String
     * @SWG\Property(type="string", description="dateTime iso8601", example="1990-02-15T00:00:00+00:00")
     */
    public $birthdate;

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * @return String|null
     */
    public function getBirthdate(): ?string
    {
        return $this->birthdate;
    }

    /**
     * @param String|null $birthdate
     */
    public function setBirthdate(?string $birthdate): void
    {
        $this->birthdate = $birthdate;
    }
}