<?php


namespace App\Service\Student\AddStudentGradeService\Dto;

use Swagger\Annotations as SWG;

/**
 * Class AddStudentGradeDTO
 * @package App\Service\Student\AddStudentGradeService\Dto
 */
class AddStudentGradeDTO
{
    /**
     * @var float
     * @SWG\Property(type="float", example="8.2")
     */
    public $value;

    /**
     * @var int
     * @SWG\Property(type="integer", description="subject id", example="1")
     */
    public $subject;

    /**
     * @return int
     */
    public function getSubject(): int
    {
        return $this->subject;
    }

    /**
     * @param int $subject
     */
    public function setSubject(int $subject): void
    {
        $this->subject = $subject;
    }
}